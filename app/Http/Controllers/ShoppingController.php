<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BillOutput;
use App\BillDetail;
use App\StoreProduct;
class ShoppingController extends Controller
{
    public function getProduct(Request $request)
    {
      $qty = $request->qty;
      if ($qty === NULL) {
        $qty = 1;
      }
      $product = DB::table('store_products')
                  ->join('products', 'store_products.product_id', '=', 'products.id')
                  ->select('store_products.id','store_products.price','products.name')
                  ->where('store_products.id', '=', $request->id)
                  ->where('store_products.qty', '>=', $qty)
                  ->get()->first();
      $product->qty = $qty;
      $product->subtotal = $product->qty * $product->price;
      return response()->json([
        'message'=>'success',
        'product'=>$product
      ]);
    }

    public function payment(Request $request)
    {
      $bill = new BillOutput;
      $bill->created = date("Y-m-d H:i:s");
      $bill->employee_id = $request->employee_id;
      $bill->save();

      $products = $request->products;

      foreach ($products as $key => $value) {
        $item = new BillDetail;
        $item->bill_output_id = $bill->id;
        $item->product_id = $value['id'];
        $item->qty = $value['qty'];
        $item->save();

        $product = StoreProduct::find($value['id']);
        $product->qty -= $value['qty'];
        $product->save();
      }

      return response()->json([
        'message'=>'success',
        'billID'=>$bill->id
      ]);
    }

    public function billDetail($id)
    {
      $data = DB::table('bill_outputs')
              ->join('bill_details', 'bill_outputs.id', '=', 'bill_details.bill_output_id')
              ->join('store_products', 'bill_details.product_id', '=', 'store_products.id')
              ->join('products', 'store_products.product_id', '=', 'products.id')
              ->select('products.name', 'bill_details.qty as qty', 'store_products.price as price')
              ->where('bill_outputs.id', '=', $id)
              ->get();
      $total = 0;
      foreach ($data as $key => $value) {
        $value->subtotal = (int)$value->qty * (int)$value->price;
        $total += $value->subtotal;
      }
      return view('bill', compact('data','total'));
    }
}
