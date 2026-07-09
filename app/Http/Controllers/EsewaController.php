<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class EsewaController extends Controller
{
public function initiate(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:0.01',
    ]);

    $amount = $request->amount;
    $tax_amount = 0;
    $total_amount = $amount + $tax_amount;
    $transaction_uuid = uniqid('txn_', true);
    $product_code = config('services.esewa.merchant_code');
    $process_url = config('services.esewa.api_endpoint');
    $secret_key = config('services.esewa.secret_key');

    // Generate signature
    $message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
    $signature = $this->generateSignature($message, $secret_key);

    // eSewa Form data
    $form_data = [
        'amount' => $amount,
        'tax_amount' => $tax_amount,
        'total_amount' => $total_amount,
        'transaction_uuid' => $transaction_uuid,
        'product_code' => $product_code,
        'product_service_charge' => '0',
        'product_delivery_charge' => '0',
        'success_url' => route('payment.success'),
        'failure_url' => route('payment.failed'),
        'signed_field_names' => 'total_amount,transaction_uuid,product_code',
        'signature' => $signature,
    ];

    // ✅ Ensure single product in cart
    $cartItem = \App\Models\Cart::where('user_id', auth()->id())->first();

    if (!$cartItem) {
        return back()->with('error', 'Your cart is empty.');
    }

    // ✅ Create order with product_id
    $order = Order::create([
        'user_id' => auth()->id(),
        'product_id' => $cartItem->product_id,
        'txn_id' => $transaction_uuid,
        'amount' => $total_amount,
        'esewa_status' => 'pending',
    ]);

    return view('esewa', compact('process_url', 'form_data'));
}

    public function esewaSuccess()
    {
        return view('paymentsuccess');
    }

    public function esewaFail(Request $request)
    {
        $txn_id = $request->transaction_uuid;

        if (!$txn_id) {
            return redirect()->route('home')->with('error', 'Transaction ID missing.');
        }

        DB::table('orders')
            ->where('txn_id', $txn_id)
            ->update([
                'esewa_status' => 'failed',
                'updated_at' => Carbon::now(),
            ]);

        return view('paymentfail');
    }

    public function verification(Request $request)
    {
        $encodedData = $request->input('data');
        if (!$encodedData) {
            return view('paymentfail', ['error' => 'Missing verification data.']);
        }

        $decodedString = base64_decode($encodedData);
        $data = json_decode($decodedString, true);

        if (!$data) {
            return view('paymentfail', ['error' => 'Invalid data format.']);
        }

        if (!$this->checkSignature($data)) {
            return view('paymentfail', ['error' => 'Invalid Signature!']);
        }

        if (($data['status'] ?? null) === 'COMPLETE') {
            $order = Order::where('txn_id', $data['transaction_uuid'])->first();
            if ($order) {
                // Verify transaction with eSewa status check API
                $isVerified = $this->reVerify($order, $data);
                if ($isVerified) {
                    $order->update([
                        'esewa_status' => 'completed',
                    ]);

                    // Clear cart after successful payment
                    \App\Models\Cart::where('user_id', auth()->id())->delete();

                    return view('paymentsuccess', [
                        'txn_code' => $data['transaction_code']
                    ]);
                }
            }
            return view('paymentfail', ['error' => 'Transaction verification failed.']);
        }

        return view('paymentfail', ['error' => 'Payment verification failed!']);
    }

    public function reVerify(Order $order, array $data)
    {
        $merchant_code = config('services.esewa.merchant_code');
        $total_amount = $data['total_amount'] ?? 0;
        $transaction_uuid = $data['transaction_uuid'] ?? null;

        if (!$transaction_uuid) {
            Log::error('Re-verify called without transaction_uuid');
            return false;
        }

        $payload = [
            'product_code' => $merchant_code,
            'transaction_uuid' => $transaction_uuid,
            'total_amount' => $total_amount,
        ];

        try {
            $response = Http::get(config('services.esewa.status_check_url'), $payload);

            if (!$response->successful()) {
                Log::error('eSewa status inquiry failed', ['response' => $response->body()]);
                return false;
            }

            $inquiry = $response->json();
            $status = ($inquiry['status'] ?? null) === 'COMPLETE';

            if ($status) {
                $order->update([
                    'esewa_status' => 'completed',
                ]);
            } else {
                $order->update([
                    'esewa_status' => 'failed',
                ]);
            }

            return $status;
        } catch (\Exception $e) {
            Log::error('eSewa status check exception', ['error' => $e->getMessage()]);
            return false;
        }
    }

    private function generateSignature(string $message, string $secret): string
    {
        $signature = hash_hmac('sha256', $message, $secret, true);
        return base64_encode($signature);
    }

    private function checkSignature(array $data): bool
    {
        $amount = str_replace(',', '', $data['total_amount'] ?? '');
        $message = "transaction_code={$data['transaction_code']},status={$data['status']},total_amount={$amount},transaction_uuid={$data['transaction_uuid']},product_code={$data['product_code']},signed_field_names={$data['signed_field_names']}";

        $signature = $data['signature'] ?? null;
        $generatedSignature = $this->generateSignature($message, config('services.esewa.secret_key'));

        return $signature === $generatedSignature;
    }
}