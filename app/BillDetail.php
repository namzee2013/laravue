<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $fillable = [
      'bill_output_id','product_id','qty'
    ];
    public function storeProduct()
    {
      return $this->belongsTo(StoreProduct::class);
    }

    public function billOutput()
    {
      return $this->belongsTo(BillOutput::class);
    }
}
