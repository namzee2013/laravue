<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Notifiable;

    protected $fillable = [
      'username', 'password', 'fullname', 'avatar', 'birthday', 'gender', 'address', 'phone', 'role_id'
    ];

    // protected $hidden = [
    //     'password'
    // ];

    public function role()
    {
      return $this->belongsTo(Role::class);
    }
    public function billInput()
    {
      return $this->hasMany(BillInput::class);
    }

    public function billOutput()
    {
      return $this->hasMany(BillOutput::class);
    }
}
