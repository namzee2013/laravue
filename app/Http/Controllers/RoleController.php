<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Role;
class RoleController extends Controller
{
    public function index()
    {
      $roles = DB::table('roles')
      ->select('*')
      ->get();

      return response()->json([
        'message' => 'success',
        'roles' => $roles
      ]);
    }
    public function store(Request $request)
    {
      $this->validate($request, [
        'role'=>'required|unique:roles,role',
        'description'=>'required'
      ]);
      Role::create($request->all());
      return response()->json([
        'message' => 'success',
        'role' => $request->all()
      ]);
    }
    public function edit($id)
    {
      $role = Role::find($id);
      return response()->json([
        'message'=> 'success',
        'role'=>$role
      ]);
    }
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'role'=>'required',
        'description'=>'required'
      ]);

      Role::findOrFail($id)->update($request->all());

      return response()->json([
        'message'=>'success'
      ]);
    }

    public function destroy($id)
    {
      $role = Role::findOrFail($id);
      $role->delete();
      return response()->json([
        'message'=>'success'
      ]);
    }
}
