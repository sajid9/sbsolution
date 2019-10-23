<?php
/*use App\company_setting;*/
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
 Route::get('sendemail','CsvFile@sendMail');
 Route::get('CsvFile','CsvFile@index');
 Route::get('exportCsv','CsvFile@exportCsv');
 Route::post('importCsv','CsvFile@importCsv');
/*View::share('company', company_setting::first());*/
/*
*
*Company Routes
*
*/
Route::prefix('company')->middleware(['auth'])->group(function () {
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
Route::prefix('category')->middleware(['auth'])->group(function () {
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
Route::prefix('class')->middleware(['auth'])->group(function () {
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
Route::prefix('subclass')->middleware(['auth'])->group(function () {
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
Route::prefix('supplier')->middleware(['auth'])->group(function () {
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
Route::prefix('customer')->middleware(['auth'])->group(function () {
    Route::get('customerlisting','Customers\Customer@customer_listing');
    Route::get('addcustomerform','Customers\Customer@add_customer_form');
    Route::post('addcustomer','Customers\Customer@addcustomer');
    Route::get('editcustomer/{id}','Customers\Customer@editcustomer');
    Route::post('updatecustomer','Customers\Customer@updatecustomer');
    Route::get('deletecustomer/{id}','Customers\Customer@deletecustomer');
    Route::post('addcustomerreceipt','Customers\Customer@addcustomerreceipt');

});

/*
*
*Countries Routes
*
*/
Route::prefix('country')->middleware(['auth'])->group(function () {
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
Route::prefix('item')->middleware(['auth','Item'])->group(function () {
    Route::get('itemlisting','Items\Item@item_listing');
    Route::get('additemform','Items\Item@add_item_form');
    Route::post('additem','Items\Item@additem');
    Route::get('edititem/{id}','Items\Item@edititem');
    Route::post('updateitem','Items\Item@updateitem');
    Route::get('deleteitem/{id}','Items\Item@deleteitem');
    Route::post('getspecificitem','Items\Item@get_specific_item');
    Route::get('tiletemplate','Items\Item@tile_template');

});

/*
*
*Items Voucher
*
*/
Route::prefix('voucher')->middleware(['auth'])->group(function () {
    Route::get('voucherlisting','Purchase\PurchaseOrder@voucher_listing');
    Route::get('addvoucherform','Purchase\PurchaseOrder@add_voucher_form');
    Route::post('addvoucher','Purchase\PurchaseOrder@addvoucher');
    Route::post('searchvoucher','Purchase\PurchaseOrder@searchvoucher');
    Route::post('searchbarcode','Purchase\PurchaseOrder@searchbarcode');
    Route::post('additem','Purchase\PurchaseOrder@additem');
    Route::post('savevoucher','Purchase\PurchaseOrder@savevoucher');
    Route::post('updatevoucher','Purchase\PurchaseOrder@updatevoucher');
    Route::post('removeitem','Purchase\PurchaseOrder@removeitem');
    Route::post('removereturnitem','Purchase\PurchaseOrder@removereturnitem');
    Route::get('editvoucher/{id}','Purchase\PurchaseOrder@editvoucher');
    Route::post('selectsupplier','Purchase\PurchaseOrder@selectsupplier');
    Route::get('receivinglisting/{voucher}/{item}','Purchase\Voucherreceiving@receiving_listing');
    Route::get('add_receiving_form/{voucher}/{item}','Purchase\Voucherreceiving@add_receiving_form');
    Route::post('addreceiving','Purchase\Voucherreceiving@add_receiving');
    Route::get('receivingstore/{voucher}/{item}/{qty}/{receiving_id}','Purchase\Voucherreceiving@receiving_store');
    Route::get('addreceivingstoreform/{voucher}/{item}/{qty}/{receiving_id}','Purchase\Voucherreceiving@add_receiving_store_form');
    Route::post('addreceivingstore','Purchase\Voucherreceiving@add_receiving_store');
    Route::post('returnitem','Purchase\Voucherreceiving@return_item');
    Route::post('getreturned','Purchase\Voucherreceiving@get_returned_total');
    Route::get('directin','Purchase\PurchaseOrder@direct_in');
    Route::post('saveitem','Purchase\PurchaseOrder@save_item');

});

/*
*
*Payments
*
*/
Route::prefix('payment')->middleware(['auth'])->group(function(){
    Route::get('paymentlisting','payments\payment@paymentlisting');
    Route::get('addpaymentform','payments\payment@addpaymentform');
    Route::post('addpayment','payments\payment@addpayment');
    Route::post('addpaymentsale','payments\payment@addpaymentsale');
    Route::get('addsopayment/{receiptId}/{totalAmount}/{customerId}','payments\payment@addsopayment');
    Route::get('financialyear','payments\payment@financialyear');
    Route::get('addfinancialyear','payments\payment@addfinancialyear');
    Route::post('addfnyear','payments\payment@add_fnyear');
    Route::get('deleteyear/{id}','payments\payment@delete_year');
    Route::post('checkamount','payments\payment@check_paid_amount');
    Route::post('getaccountinfo','payments\payment@get_account_info');
});

/*
*
*Item Ledger
*
*/
Route::prefix('ledger')->middleware(['auth'])->group(function(){
    Route::get('itemledger','ledger\Ledger_item@item_ledgers')->middleware('ItemLedger');
    Route::get('getitems','ledger\Ledger_item@search_item');
    Route::post('searchitem','ledger\Ledger_item@search_itemledger');
    Route::get('voucherhistory','ledger\Ledger_supplier@supplier_ledgers');
    Route::get('supplierhistory','ledger\Ledger_supplier@supplier_history');
    Route::get('getsupplier','ledger\Ledger_supplier@get_supplier');
    Route::get('getvoucher','ledger\Ledger_supplier@get_voucher');
    Route::get('getcustomer','ledger\Ledger_supplier@get_customer');
    Route::get('getreceipt','ledger\Ledger_supplier@get_receipt');
    Route::post('searchvoucher','ledger\Ledger_supplier@search_voucher');
    Route::post('searchsupplier','ledger\Ledger_supplier@search_supplier');
    Route::post('searchcustomer','ledger\Ledger_supplier@search_customer');
    Route::post('searchreceipt','ledger\Ledger_supplier@search_receipt');
    Route::get('customerledger','ledger\customer_history@customer_ledger');
    Route::get('receiptledger','ledger\receipt_history@receipt_ledger');
    Route::get('accountledgerform','ledger\accountledger@accountledgerform');
    Route::post('accountledger','ledger\accountledger@accountledger');
    Route::get('stockreport','ledger\accountledger@stockreport');
});
/*
*
*sale order
*
*/
Route::prefix('sale')->middleware(['auth'])->group(function(){
    Route::get('saleorder','sale\saleorder@salelisting');
    Route::get('addreceiptform','sale\saleorder@receiptform');
    Route::post('addreceipt','sale\saleorder@addreceipt');
    Route::post('additem','sale\saleorder@additem');
    Route::post('savereceipt','sale\saleorder@savereceipt');
    Route::get('editreceipt/{id}','sale\saleorder@editreceipt');
    Route::post('returnitem','sale\saleorder@returnitem');
    Route::post('updatereceipt','sale\saleorder@updatereceipt');
    Route::post('searchbarcode','sale\saleorder@searchbarcode');
    Route::post('selectcustomer','sale\saleorder@selectcustomer');

    Route::get('deliverylisting/{receipt}/{item}','sale\receiptdelivery@delivery_listing');
    Route::get('add_delivery_form/{receipt}/{item}','sale\receiptdelivery@add_delivery_form');
    
    Route::post('adddevlivery','sale\receiptdelivery@add_delivery');
    
    Route::get('storelisting/{receipt}/{item}/{qty}/{delivery_id}','sale\receiptdelivery@store_listing');
    Route::get('adddeliverystoreform/{receipt}/{item}/{qty}/{delivery_id}','sale\receiptdelivery@add_delivery_store_form');
    Route::post('adddeliverystore','sale\receiptdelivery@add_delivery_store');
    
    Route::post('returnitem','sale\receiptdelivery@return_item');
    Route::post('getreturned','sale\receiptdelivery@get_returned_total');
    Route::get('directout','sale\saleorder@direct_out');
    Route::post('saveitem','sale\saleorder@save_item');
    
});
/*
*
*opening
*
*/
Route::prefix('opening')->middleware(['auth'])->group(function(){
    Route::get('addItem','opening\opening_controller@addItem');
    Route::post('saveitem','opening\opening_controller@save_item');
    Route::get('supplier','opening\opening_controller@supplier');
    Route::post('savesupplier','opening\opening_controller@save_supplier');
    Route::get('customer','opening\opening_controller@customer');
    Route::post('savecustomer','opening\opening_controller@save_customer');
    Route::get('accounts','opening\opening_controller@opening_account');
    Route::post('saveaccount','opening\opening_controller@save_account');
    Route::get('accountlisting','opening\opening_controller@account_listing');
    Route::get('cashdeposit','opening\opening_controller@cash_deposit');
    Route::post('savedeposit','opening\opening_controller@save_deposit');
    Route::get('cashwithdraw','opening\opening_controller@cash_withdraw');
    Route::post('savewithdraw','opening\opening_controller@save_withdraw');
});
/*
*
*invoice
*
*/
Route::prefix('invoice')->middleware(['auth'])->group(function(){
    Route::get('sale/{id}','invoices\invoice@saleinvoice');
    Route::get('salereturn/{id}','invoices\invoice@salereturninvoice');
    Route::get('purchasereturn/{id}','invoices\invoice@purchasereturninvoice');
    Route::get('amountpayable','invoices\invoice@amountpayable');
    Route::get('amountreceivable','invoices\invoice@amountreceivable');
    Route::get('supplierpayable','invoices\invoice@supplierpayable');
    Route::get('customerreceivable','invoices\invoice@customerreceivable');
    Route::post('supplierpayableinvoice','invoices\invoice@supplierpayableinvoice');
    Route::post('customerreceivableinvoice','invoices\invoice@customerreceivableinvoice');
});
/*
*
*store
*
*/
Route::prefix('store')->middleware(['auth','Roles'])->group(function(){
    Route::get('storelisting','stores\store@store_listing');
    Route::get('addstoreform','stores\store@add_store_form');
    Route::get('editstore/{id}','stores\store@edit_store');
    Route::get('deletestore/{id}','stores\store@delete_store');
    Route::post('addstore','stores\store@add_store');
    Route::post('updatestore','stores\store@update_store');
});

/*
*
*group
*
*/
Route::prefix('group')->middleware(['auth','Group'])->group(function(){
    Route::get('grouplisting','groups\group@group_listing');
    Route::get('addgroupform','groups\group@add_group_form');
    Route::post('addgroup','groups\group@add_group');
    Route::get('editgroup/{id}','groups\group@edit_group');
    Route::post('updategroup','groups\group@update_group');
    
});
/*
*
*size
*
*/
Route::prefix('size')->middleware(['auth'])->group(function(){
    Route::get('sizelisting','sizes\size@size_listing');
    Route::get('addsizeform','sizes\size@add_size_form');
    Route::post('addsize','sizes\size@add_size');
    Route::get('editsize/{id}','sizes\size@edit_size');
    Route::post('updatesize','sizes\size@update_size');
    
});
/*
*
*measuring unit
*
*/
Route::prefix('measuring')->middleware(['auth'])->group(function(){
    Route::get('unitlisting','measuring\unit@unit_listing');
    Route::get('addunitform','measuring\unit@add_unit_form');
    Route::post('addunit','measuring\unit@addunit');
    Route::get('editunit/{id}','measuring\unit@edit_unit');
    Route::post('updateunit','measuring\unit@update_unit');
});
/*
*
*expenditure
*
*/
Route::prefix('expenditure')->middleware(['auth'])->group(function(){
    Route::get('headlisting','expenditure\expenditure@headlisting');
    Route::get('addhead','expenditure\expenditure@addhead');
    Route::post('savehead','expenditure\expenditure@savehead');
    Route::get('edithead/{id}','expenditure\expenditure@edithead');
    Route::post('updatehead','expenditure\expenditure@updatehead');
    Route::get('subheadlisting/{id}','expenditure\expenditure@subheadlisting');
    Route::get('addsubhead/{id}','expenditure\expenditure@addsubhead');
    Route::post('savesubhead','expenditure\expenditure@savesubhead');
    Route::get('editsubhead/{id}','expenditure\expenditure@editsubhead');
    Route::post('updatesubhead','expenditure\expenditure@updatesubhead');
    Route::get('monthlisting','expenditure\expenditure@monthlisting');
    Route::get('addmonthform','expenditure\expenditure@addmonthform');
    Route::post('addmonth','expenditure\expenditure@addmonth');
    Route::get('editmonth/{id}','expenditure\expenditure@editmonth');
    Route::post('updatemonth','expenditure\expenditure@updatemonth');
    Route::post('getsubhead','expenditure\expenditure@getsubhead');
});
/*
*
*user
*
*/
Route::prefix('user')->middleware(['auth'])->group(function(){
    Route::get('companysetting','User\User@company_setting');
    Route::post('addcompanysetting','User\User@add_company_setting');
    Route::get('profile','User\User@profile');
    Route::post('updateprofile','User\User@update_profile');
    Route::get('changepassword','User\User@change_password');
    Route::post('updatepassword','User\User@update_password');
});

/*
*
*user and role mange mangement
*
*/
Route::prefix('user_mangement')->middleware(['auth'])->group(function(){
    Route::get('/', 'User_mangement\dashboardController@index')->name('user_mangement_homepanel');
    Route::post('/role', 'User_mangement\RoleController@insert')->name('insert_user_role');
    Route::get('role/delete/{id}', 'User_mangement\RoleController@destroy')->name('delete_role');
    Route::post('role/edit/{id}', 'User_mangement\RoleController@update')->name('edit_role');
    Route::post('/', 'User_mangement\CreateuserController@insert')->name('insert_user');
    Route::post('addauthority', 'User_mangement\CreateuserController@add_authority');
    Route::get('user/delete/{id}', 'User_mangement\CreateuserController@destroy')->name('delete_user');
    Route::post('user/edit/{id}', 'User_mangement\CreateuserController@update')->name('edit_user');
    Route::post('checkrole', 'User_mangement\CreateuserController@check_role')->name('checkrole');
    Route::get('getauthority', 'User_mangement\dashboardController@get_authority');
});
 

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->middleware('verified')->name('home');


Route::get('/changePassword','HomeController@showChangePasswordForm');
