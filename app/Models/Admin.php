<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Define the table associated with the model
    protected $table = 'admins';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = ['name', 'email', 'password'];

    // Define the hidden attributes
    protected $hidden = ['password', 'remember_token'];
}