<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;


class Product extends Model
{
    use HasFactory;

    // One To Many (Inverse) / Belongs To  -- Categoryde ki ilişkiye cevap verebilmesi için ters bağlılık olarak burda da bunu yazmamız lazım
    public function category()
    {
        return $this->belongsTo(Category::class); // Category ye aitlik var gibi bişey
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); 
    }
}
