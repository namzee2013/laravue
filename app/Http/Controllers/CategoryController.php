<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{

    public function index()
    {
      $categories = DB::table('categories')
      ->select('*')
      ->get();

      return response()->json([
        'message' => 'success',
        'categories' => $categories
      ]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'=>'required|unique:categories,name',
        'description'=>'required'
      ]);
      Category::create($request->all());
      return response()->json([
        'message' => 'success',
        'category' => $request->all()
      ]);
    }
    public function edit($id)
    {
      $category = Category::find($id);
      return response()->json([
        'message'=> 'success',
        'category'=>$category
      ]);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name'=>'required',
        'description'=>'required'
      ]);

      Category::findOrFail($id)->update($request->all());

      return response()->json([
        'message'=>'success'
      ]);
    }

    public function destroy($id)
    {
      $category = Category::findOrFail($id);
      $category->delete();
      return response()->json([
        'message'=>'success'
      ]);
    }

}
