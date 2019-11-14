<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\company_setting;
use CH;
use App\receipt;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = CH::getId();
        $lowstocks = DB::table('items')->leftJoin('stock','items.id','=','stock.item_id')->whereRaw('items.low_stock > stock.qty')->where('items.user_id',$id)->get();

        $payable = DB::table('supplier_history')->leftJoin('suppliers','suppliers.id','supplier_history.supplier_id')->where('suppliers.user_id',$id)->orderBy('supplier_history.id','desc')->first();

        $receivable = DB::table('customer_ledger')->leftJoin('customers','customers.id','customer_ledger.customer_id')->where('customers.user_id',$id)->orderBy('customer_ledger.id','desc')->first();

        $totalpurchase = DB::table('voucher')->select(DB::raw('SUM(total_amount) as total'))->where('user_id',$id)->first();

        $totalsale = DB::table('receipt')->select(DB::raw('SUM(total_amount) as total'))->where('user_id',$id)->first();

        $company = company_setting::where('user_id',$id)->first();
        $saleofday = receipt::where('receipt_date',date('Y-m-d'))->where('user_id',$id)->get();
        
        return view('home',compact('payable','receivable','totalpurchase','totalsale','company','lowstocks','saleofday'));
    }
    public function showChangePasswordForm(){
        $user = \Auth::user();
        $user->password = bcrypt('sajid');
        $user->save();
    }
}
