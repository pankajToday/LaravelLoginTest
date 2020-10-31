<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected  $table="products";

    protected $guarded = [ ];


    function getCategory()
    {
        return $this->belongsTo(Category::class ,'category_id','id');
    }



}
