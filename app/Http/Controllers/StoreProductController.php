<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreProduct;
use DB;
class StoreProductController extends Controller
{
    public function store(Request $request)
    {
      $this->validate($request, [
        'product_id'=>'required',
        'qty'=>'required',
        'price_bought'=>'required',
        'status'=>'required',
        'price'=>'required'
      ]);

      $product = new StoreProduct($request->all());
      $product->save();
      $product->name = DB::table('products')
            ->select('name')
            ->where('id', '=', $request->product_id)
            ->get()->first()->name;
      return response()->json([
        'message'=>'success',
        'product'=>$product
      ]);
    }

    public function destroy($id)
    {
      $product = StoreProduct::findOrFail($id);
      $product->delete();
      return response()->json([
        'message'=>'success'
      ]);
    }
}
