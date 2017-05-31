<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'role','description'
    ];
    public function employee()
    {
      return $this->hasMany(Employee::class);
    }
}
