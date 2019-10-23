<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\company_setting;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified','auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $payable = DB::table('supplier_history')->orderBy('id','desc')->first();
        $receivable = DB::table('customer_ledger')->orderBy('id','desc')->first();
        $totalpurchase = DB::table('voucher')->select(DB::raw('SUM(total_amount) as total'))->first();
        $totalsale = DB::table('receipt')->select(DB::raw('SUM(total_amount) as total'))->first();
        $company = company_setting::first();
        return view('home',compact('payable','receivable','totalpurchase','totalsale','company'));
    }
    public function showChangePasswordForm(){
        $user = \Auth::user();
        $user->password = bcrypt('sajid');
        $user->save();
    }
}
