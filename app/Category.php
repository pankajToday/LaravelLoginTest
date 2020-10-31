<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected  $table="categories";

    protected $guarded = [ ];


    function getProducts()
    {
        return $this->hasMany(Product::class ,'category_id','id');
    }

}
