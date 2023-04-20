<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'product_title',
        'quantity',
        'image',
        'product_id',
        'user_id',
        'payment_status',
        'delivery_status',
    ];

}
