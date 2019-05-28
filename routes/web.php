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
    return view('pages.dashboard');
});
/*
*
*Company Routes
*
*/
Route::prefix('company')->group(function () {
    Route::get('companylisting','Companies\Company@company_listing');
    Route::get('addcompanyform','Companies\Company@add_company_form');
    Route::post('addcompany','Companies\Company@addcompany');
    Route::get('editcompany/{id}','Companies\Company@editcompany');
    Route::post('updatecompany','Companies\Company@updatecompany');
    Route::get('deletecompany/{id}','Companies\Company@deletecompany');

});

/*
*
*Categories Routes
*
*/
Route::prefix('category')->group(function () {
    Route::get('categorylisting','Categories\Category@category_listing');
    Route::get('addcategoryform','Categories\Category@add_category_form');
    Route::post('addcategory','Categories\Category@addcategory');
    Route::get('editcategory/{id}','Categories\Category@editcategory');
    Route::post('updatecategory','Categories\Category@updatecategory');
    Route::get('deletecategory/{id}','Categories\Category@deletecategory');

});
/*
*
*Classes Routes
*
*/
Route::prefix('class')->group(function () {
    Route::get('classlisting','Classes\ClassController@class_listing');
    Route::get('addclassform','Classes\ClassController@add_class_form');
    Route::post('addclass','Classes\ClassController@addclass');
    Route::get('editclass/{id}','Classes\ClassController@editclass');
    Route::post('updateclass','Classes\ClassController@updateclass');
    Route::get('deleteclass/{id}','Classes\ClassController@deleteclass');
});

/*
*
*Subclasses Routes
*
*/
Route::prefix('subclass')->group(function () {
    Route::get('classlisting/{id}','Classes\SubClassController@class_listing');
    Route::get('addsubclassform/{id}','Classes\SubClassController@add_sub_class_form');
    Route::post('addclass','Classes\SubClassController@addclass');
    Route::get('editclass/{id}','Classes\SubClassController@editclass');
    Route::post('updateclass','Classes\SubClassController@updateclass');
    Route::get('deleteclass/{parent_id}/{id}','Classes\SubClassController@deleteclass');
    Route::post('getsubclass','Classes\SubClassController@getsubclass');
});

/*
*
*Supplier Routes
*
*/
Route::prefix('supplier')->group(function () {
    Route::get('supplierlisting','Suppliers\Supplier@supplier_listing');
    Route::get('addsupplierform','Suppliers\Supplier@add_supplier_form');
    Route::post('addsupplier','Suppliers\Supplier@addsupplier');
    Route::get('editsupplier/{id}','Suppliers\Supplier@editsupplier');
    Route::post('updatesupplier','Suppliers\Supplier@updatesupplier');
    Route::get('deletesupplier/{id}','Suppliers\Supplier@deletesupplier');

});

/*
*
*Customer Routes
*
*/
Route::prefix('customer')->group(function () {
    Route::get('customerlisting','Customers\Customer@customer_listing');
    Route::get('addcustomerform','Customers\Customer@add_customer_form');
    Route::post('addcustomer','Customers\Customer@addcustomer');
    Route::get('editcustomer/{id}','Customers\Customer@editcustomer');
    Route::post('updatecustomer','Customers\Customer@updatecustomer');
    Route::get('deletecustomer/{id}','Customers\Customer@deletecustomer');

});

/*
*
*Countries Routes
*
*/
Route::prefix('country')->group(function () {
    Route::get('countrylisting','Countries\Country@country_listing');
    Route::get('addcountryform','Countries\Country@add_country_form');
    Route::post('addcountry','Countries\Country@addcountry');
    Route::get('editcountry/{id}','Countries\Country@editcountry');
    Route::post('updatecountry','Countries\Country@updatecountry');
    Route::get('deletecountry/{id}','Countries\Country@deletecountry');

});

/*
*
*Items Routes
*
*/
Route::prefix('item')->group(function () {
    Route::get('itemlisting','Items\Item@item_listing');
    Route::get('additemform','Items\Item@add_item_form');
    Route::post('additem','Items\Item@additem');
    Route::get('edititem/{id}','Items\Item@edititem');
    Route::post('updateitem','Items\Item@updateitem');
    Route::get('deleteitem/{id}','Items\Item@deleteitem');

});

/*
*
*Items Voucher
*
*/
Route::prefix('voucher')->group(function () {
    Route::get('voucherlisting','Purchase\PurchaseOrder@voucher_listing');
    Route::get('addvoucherform','Purchase\PurchaseOrder@add_voucher_form');
    Route::post('addvoucher','Purchase\PurchaseOrder@addvoucher');
    Route::post('searchvoucher','Purchase\PurchaseOrder@searchvoucher');
    Route::post('searchbarcode','Purchase\PurchaseOrder@searchbarcode');
    Route::post('additem','Purchase\PurchaseOrder@additem');
    Route::post('savevoucher','Purchase\PurchaseOrder@savevoucher');
    Route::post('removeitem','Purchase\PurchaseOrder@removeitem');
    Route::get('editvoucher/{id}','Purchase\PurchaseOrder@editvoucher');
    Route::post('returnitem','Purchase\PurchaseOrder@returnitem');

});

/*
*
*Payments
*
*/
Route::prefix('payment')->group(function(){
    Route::get('paymentlisting','payments\payment@paymentlisting');
    Route::get('addpaymentform','payments\payment@addpaymentform');
    Route::post('addpayment','payments\payment@addpayment');

});

/*
*
*Item Ledger
*
*/
Route::prefix('ledger')->group(function(){
    Route::get('itemledger','ledger\Ledger_item@item_ledgers');
    Route::get('getitems','ledger\Ledger_item@search_item');

});

