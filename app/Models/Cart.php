<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // protected $fillable = ['user_id', 'product_id', 'quantity'];

    // // Relationship to Product
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // Relationship to User (optional)
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
