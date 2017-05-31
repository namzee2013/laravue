<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BillInput;
class BillInputController extends Controller
{
    public function index()
    {
      $billInputs = DB::table('bill_inputs')
                  ->join('employees', 'employees.id', '=', 'bill_inputs.employee_id')
                  ->select('bill_inputs.id','created','fullname')
                  ->orderBy('bill_inputs.id', 'DESC')
                  ->get();
      foreach ($billInputs as $key => $value) {
        $count = DB::table('store_products')->select('*')->where('bill_input_id', '=', $value->id)->get();
        $billInputs[$key]->count = count($count);
      }
      return response()->json([
        'message'=>'success',
        'billInputs'=>$billInputs
      ]);

    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'created'=> 'required'
      ]);
      $bill = new BillInput;
      $bill->created = date('Y-m-d H:i:s', strtotime($request->created));
      $bill->employee_id = $request->employee_id;
      $bill->save();
      $count = DB::table('store_products')->select('id')->where('bill_input_id', '=', $bill->id)->get();
      $bill->count = count($count);
      $bill->fullname = DB::table('employees')->select('fullname')->where('id', '=', $bill->employee_id)->get()->first()->fullname;
      return response()->json([
        'message'=>'success',
        'billInput'=>$bill
      ]);
    }

    public function getProductForBill($billId)
    {
      $data = DB::table('store_products')
              ->join('products', 'store_products.product_id', '=', 'products.id')
              ->join('categories', 'products.category_id', '=', 'categories.id')
              ->select('store_products.id as id','products.name as name','qty','price_bought','price','categories.name as category_name')
              ->where('store_products.bill_input_id', '=', $billId)
              ->orderBy('store_products.id', 'DESC')
              ->get();
      return response()->json([
        'message'=>'success',
        'productsForBill'=>$data
      ]);
    }

    public function destroy($id)
    {
      $bill = BillInput::findOrFail($id);
      $bill->delete();
      return response()->json([
        'message'=>'success'
      ]);
    }
}
