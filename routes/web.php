<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('vue');
});
Route::group(['prefix'=>'api'], function(){
  Route::post('login', 'LoginController@login');
  Route::post('register', 'LoginController@register');
  Route::group(['prefix'=>'role'], function(){
    Route::get('/', 'RoleController@index');
    Route::post('store', 'RoleController@store');
    Route::get('edit/{id}', 'RoleController@edit');
    Route::post('update/{id}', 'RoleController@update');
    Route::get('destroy/{id}', 'RoleController@destroy');
  });

  Route::group(['prefix'=> 'employee'], function(){
    Route::get('/', 'EmployeeController@index');
    Route::post('store', 'EmployeeController@store');
    Route::get('edit/{id}', 'EmployeeController@edit');
    Route::post('update/{id}', 'EmployeeController@update');
    Route::get('destroy/{id}', 'EmployeeController@destroy');
  });

  Route::group(['prefix'=>'category'], function(){
    Route::get('/', 'CategoryController@index');
    Route::post('store', 'CategoryController@store');
    Route::get('edit/{id}', 'CategoryController@edit');
    Route::post('update/{id}', 'CategoryController@update');
    Route::get('destroy/{id}', 'CategoryController@destroy');
  });

  Route::group(['prefix'=>'product'], function(){
    Route::get('/', 'ProductController@index');
    Route::post('store', 'ProductController@store');
    Route::get('edit/{id}', 'ProductController@edit');
    Route::post('update/{id}', 'ProductController@update');
    Route::get('destroy/{id}', 'ProductController@destroy');
  });

  Route::group(['prefix'=>'bill-input'], function(){
    Route::get('/', 'BillInputController@index');
    Route::post('store', 'BillInputController@store');
    Route::get('get-product/{billId}', 'BillInputController@getProductForBill');
    Route::get('destroy/{id}', 'BillInputController@destroy');

    Route::group(['prefix'=>'product'], function(){
      Route::post('store', 'StoreProductController@store');
      Route::get('destroy/{id}', 'StoreProductController@destroy');
    });
  });

  Route::group(['prefix'=>'shopping'], function(){
    Route::post('get-product', 'ShoppingController@getProduct');
    Route::post('payment', 'ShoppingController@payment');
  });
});
Route::get('bill/{id}', 'ShoppingController@billDetail');
Route::get('add-role', function(){
  DB::table('roles')->insert(
    ['role'=>'superadmin','description'=>'su']
  );
  DB::table('roles')->insert(
    ['role'=>'admin','description'=>'a']
  );
  DB::table('roles')->insert(
    ['role'=>'member','description'=>'mem']
  );
  echo "ok";
});
Route::get('store-product', function(){
  $data = DB::table('store_products')->select('id','qty')->get();
  return response()->json($data);
});
Route::get('bill-output', function(){
  $data = DB::table('bill_outputs')->select('id')->get();
  return response()->json($data);
});
