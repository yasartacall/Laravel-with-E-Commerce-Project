<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;


class Review extends Model
{
    use HasFactory;

    protected $fillable = [ // Jetstream ile uğraşırken bunu tanımlamanız gerekiyor.
        'product_id',
        'user_id',
        'IP',
        'subject',
        'review',
        'rate',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
