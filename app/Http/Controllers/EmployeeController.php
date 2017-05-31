<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;
class EmployeeController extends Controller
{
  public function index()
  {
    $employees = DB::table('employees')
    ->join('roles', 'employees.role_id', '=', 'roles.id')
    ->select('employees.id','username','fullname','avatar','birthday','gender','role')
    ->get();

    return response()->json([
      'message' => 'success',
      'employees' => $employees
    ]);
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'username'=>'required|unique:employees,username',
      'password'=>'required',
      'repassword'=>'required|same:password',
      'fullname'=>'required',
      'avatar'=>'required',
      'birthday'=>'required|date',
      'gender'=>'required',
      'address'=>'required',
      'phone'=>'required',
      'role_id'=>'required'
    ]);
    $employee = new Employee($request->all());

    $employee->password = md5($request->password);
    $employee->save();
    //Employee::create($request->all());
    return response()->json([
      'message' => 'success',
      'employee' => $employee
    ]);
  }

  public function edit($id)
  {
    $employee = DB::table('employees')
                ->select('username','fullname','avatar','birthday','gender','address','phone','role_id')
                ->where('id', '=', $id)
                ->get()->first();
    return response()->json([
      'message'=> 'success',
      'employee'=>$employee
    ]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'password'=>'required',
      'repassword'=>'required|same:password',
      'fullname'=>'required',
      'avatar'=>'required',
      'birthday'=>'required|date',
      'gender'=>'required',
      'address'=>'required',
      'phone'=>'required',
      'role_id'=>'required'
    ]);

    $employee = Employee::findOrFail($id);
    $employee->fullname = $request->fullname;
    $employee->password = md5($request->password);
    $employee->avatar = $request->avatar;
    $employee->birthday = $request->birthday;
    $employee->gender = $request->gender;
    $employee->address = $request->address;
    $employee->phone = $request->phone;
    $employee->role_id = $request->role_id;

    $employee->save();

    return response()->json([
      'message'=>'success'
    ]);
  }

  public function destroy($id)
  {
    $employee = Employee::findOrFail($id);
    $employee->delete();
    return response()->json([
      'message'=>'success'
    ]);
  }
}
