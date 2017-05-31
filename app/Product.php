<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'name','slug','intro','content','keywords','category_id'
    ];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function storeProduct()
    {
      return $this->hasMany(StoreProduct::class);
    }
}
