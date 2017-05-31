<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
class ProductController extends Controller
{
    public function index()
    {
      $products = DB::table('products')
      ->join('categories', 'products.category_id', '=', 'categories.id')
      ->select('products.id','products.name as name','slug','keywords','categories.name as category_name')
      ->get();

      return response()->json([
        'message' => 'success',
        'products' => $products
      ]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'=>'required|unique:products,name',
        'intro'=>'required',
        'content'=>'required',
        'keywords'=>'required',
        'category_id'=>'required'
      ]);
      $product = new Product($request->all());
      $product->slug =  str_slug($product->name);

      $product->save();

      return response()->json([
        'message' => 'success',
        'product' => $product
      ]);
    }

    public function edit($id)
    {
      $product = Product::find($id);
      return response()->json([
        'message'=> 'success',
        'product'=>$product
      ]);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name'=>'required',
        'intro'=>'required',
        'content'=>'required',
        'keywords'=>'required',
        'category_id'=>'required'
      ]);

      $product = Product::findOrFail($id);
      $product->name = $request->name;
      $product->slug = str_slug($request->name);
      $product->intro = $request->intro;
      $product->content = $request->content;
      $product->keywords = $request->keywords;
      $product->category_id = $request->category_id;

      $product->save();
      
      return response()->json([
        'message'=>'success'
      ]);
    }

    public function destroy($id)
    {
      $product = Product::findOrFail($id);
      $product->delete();
      return response()->json([
        'message'=>'success'
      ]);
    }
}
