<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [

        'title',
        'slug',
        'short_detail',
        'long_detail',
        'additional_info',
        'price',
        'selling_price',
        'sku',
        'stock',
        'image',


    ];



    function categories(){
       return $this->belongsToMany(Category::class);
    }



    function galleries(){
        return $this->hasMany(Gallery::class);
    }



    function featuredGallery(){
        return $this->hasMany(Gallery::class)->take(1);
    }
}
