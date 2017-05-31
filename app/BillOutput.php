<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillOutput extends Model
{
    protected $fillable = [
      'created', 'employee_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function billDetail()
    {
      return $this->hasMany(BillDetail::class);
    }
}
