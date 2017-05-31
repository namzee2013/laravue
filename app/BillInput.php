<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillInput extends Model
{
    protected $fillable = [
      'id','created', 'employee_id'
    ];

    public function employee()
    {
      return $this->belongsTo(Employee::class);
    }

    public function storeProduct()
    {
      return $this->hasMany(StoreProduct::class);
    }
}
