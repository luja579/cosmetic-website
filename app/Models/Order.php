<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

   protected $fillable = [
    'user_id',
    'product_id',
    'txn_id',
    'amount',
    'esewa_status',
];

    /**
     * The user who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product ordered (single product order).
     * NOTE: This assumes one product per order.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
