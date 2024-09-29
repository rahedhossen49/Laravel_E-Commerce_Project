<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str($value)->slug(),
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => str($value)->headline(),
        );
    }

 //* One To Many
    function subcategories(){
        return $this->hasMany(Category::class);
    }

    //* One to many Inverse
    function category(){
        return $this->belongsTo(Category::class);
    }
}
