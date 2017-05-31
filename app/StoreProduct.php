<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $fillable = [
      'product_id', 'qty', 'price_bought', 'status', 'price', 'bill_input_id'
    ];

    public function product()
    {
      return $this->belongsTo(Product::class);
    }
    public function billInput()
    {
      return $this->belongsTo(BillInput::class);
    }
    public function billDetail()
    {
      return $this->hasMany(BillDetail::class);
    }
}
