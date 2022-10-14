<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $appends = [
        'parent',
    ];




    /* Yani bunu yapmamızdaki amaç product eklerken productlara category_id veriyoruz o id veritabanında görünüyo
    Ve bizde o category_id nin bilgisini çekmek istiyoruz.*/
    // One To Many
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    // One To Many Iverse -Tersi
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');// her bir kategorinin bir tane parent yani üst kategorisi var
    }

    // One To Many 
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');// bir kategorinin birden çok alt kategorisi var
    }
}
