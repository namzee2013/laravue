<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;
class LoginController extends Controller
{

    public function login(Request $request)
    {
      $this->validate($request, [
        'username'=> 'required',
        'password'=> 'required'
      ]);
      $employee = DB::table('employees')
                ->join('roles', 'employees.role_id', '=', 'roles.id')
                ->select('employees.id','fullname','avatar','role')
                ->where('username', '=', $request->username)
                ->where('password', '=', md5($request->password))
                ->get()->first();
      if (!empty($employee)) {
        return response()->json([
          'message'=>'successfully',
          'employee'=>$employee
        ]);
      }else {
        return response()->json([
          'message'=>'empty'
        ]);
      }
    }
    public function register(Request $request)
    {
      $employee = new Employee($request->all());
      $employee->password = md5($employee->password);
      $employee->save();
      return response()->json([
        'message'=>'successfully',
        'employee'=>$employee
      ]);
    }
}
