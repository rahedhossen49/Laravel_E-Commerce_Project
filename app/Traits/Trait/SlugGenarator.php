<?php

namespace App\Traits\Trait;

trait SlugGenarator
{
    //
    function BuildSlug($title,$modelName){

 // * check the db
 $slug = str()->slug($title);
 $count = $modelName::where('slug','LIKE','%'. $slug . '%')->count();
 if ($count > 0) {
     $count = $count + 1;
     $newSlug = $slug . '-' . $count;
 }else {
     $newSlug = $slug;
 }
 return $newSlug;
    }
}
