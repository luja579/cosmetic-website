<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = $request->input('amount');
        $tax_amount = 0; // Adjust as needed
        $total_amount = $amount + $tax_amount;
        $transaction_uuid = Str::uuid()->toString();
        $product_code = config('esewa.merchant_code');
        $success_url = route('payment.success');
        $failure_url = route('payment.failure');

        // Generate HMAC-SHA256 signature
        $message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
        $signature = base64_encode(hash_hmac('sha256', $message, config('esewa.secret_key'), true));

        $data = [
            'amount' => $amount,
            'tax_amount' => $tax_amount,
            'total_amount' => $total_amount,
            'transaction_uuid' => $transaction_uuid,
            'product_code' => $product_code,
            'product_service_charge' => 0,
            'product_delivery_charge' => 0,
            'success_url' => $success_url,
            'failure_url' => $failure_url,
            'signed_field_names' => 'total_amount,transaction_uuid,product_code',
            'signature' => $signature,
        ];

        // Store transaction details in session or database for verification
        session(['transaction' => $data]);

        // Return view with form that auto-submits to eSewa
        return view('payment.esewa', compact('data'));
    }

    public function handleSuccess(Request $request)
    {
        $data = $request->input('data');
        if (!$data) {
            return redirect()->route('payment.failure')->with('error', 'No payment data received.');
        }

        // Decode Base64 response
        $decoded = json_decode(base64_decode($data), true);

        if (!$decoded || !isset($decoded['signature'])) {
            return redirect()->route('payment.failure')->with('error', 'Invalid payment response.');
        }

        // Verify signature
        $signed_field_names = explode(',', $decoded['signed_field_names']);
        $message = '';
        foreach ($signed_field_names as $field) {
            $message .= $field . '=' . $decoded[$field] . ',';
        }
        $message = rtrim($message, ',');
        $generated_signature = base64_encode(hash_hmac('sha256', $message, config('esewa.secret_key'), true));

        if ($generated_signature !== $decoded['signature']) {
            return redirect()->route('payment.failure')->with('error', 'Signature verification failed.');
        }

        if ($decoded['status'] === 'COMPLETE') {
            // Update order status in database
            // Example: Order::create([...]);
            // Clear cart after successful payment
            Cart::where('user_id', auth()->id())->delete();
            return view('payment.success', ['transaction' => $decoded]);
        }

        return redirect()->route('payment.failure')->with('error', 'Payment not completed.');
    }

    public function handleFailure(Request $request)
    {
        return view('payment.failure', ['error' => $request->input('error', 'Payment failed or was canceled.')]);
    }

    public function verifyPayment($transaction_uuid)
    {
        $response = Http::get(config('esewa.status_check_url'), [
            'product_code' => config('esewa.merchant_code'),
            'total_amount' => session('transaction.total_amount'),
            'transaction_uuid' => $transaction_uuid,
        ]);

        if ($response->successful()) {
            $status = $response->json();
            // Update order status based on $status['status']
            return response()->json($status);
        }

        return response()->json(['error' => 'Unable to verify transaction.'], 500);
    }
    public function show()
    {
        $orders = Order::with('product')
                       ->where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('profile.show', compact('orders'));
    }
}