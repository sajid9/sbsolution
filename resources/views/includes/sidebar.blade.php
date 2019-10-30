@section('sidebar')
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">{{@$company->name}}</a>
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                    {{Auth::user()->name}}
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ url('user/profile') }}"><i class="fa fa-user fa-fw"></i> Profile</a>
                    </li>
                    <li><a href="{{ url('user/companysetting') }}"><i class="fa fa-building fa-fw"></i> Company Profile</a>
                    </li>
                    <li><a href="{{ url('user/changepassword') }}"><i class="fa fa-lock fa-fw"></i>Reset Password</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <li>
                        <a href="{{url('/')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <?php 
                        if(CH::getauthorities() != null){
                            $authorities = CH::getauthorities()->authority; 
                        }else{
                            $authorities = array();
                        }
                    ?>
                    {{-- Item Info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Items Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Add Item',$authorities))
                            <li>
                                <a href="{{url('item/itemlisting')}}">Add Item</a>
                            </li>
                            @endif
                            @if(in_array('Opening item',$authorities))
                            <li>
                                <a href="{{url('opening/addItem')}}">Opening Item</a>
                            </li>
                            @endif
                            @if(in_array('Item Ledger',$authorities))
                            <li>
                                <a href="{{url('ledger/itemledger')}}">Item Ledger</a>
                            </li>
                            @endif
                            @if(in_array('Stock Report',$authorities))
                            <li>
                                <a target="_blank" href="{{url('ledger/stockreport')}}">Stock Report</a>
                            </li>
                            @endif
                            @if(in_array('Stores',$authorities))
                            <li>
                                <a href="{{url('store/storelisting')}}">Stores</a>
                            </li>
                            @endif
                            @if(in_array('Companies',$authorities))
                            <li>
                                <a href="{{url('company/companylisting')}}"> Companies</a>
                            </li>
                            @endif
                            @if(in_array('Classes',$authorities))
                            <li>
                                <a href="{{url('class/classlisting')}}">Classes</a>
                            </li>
                            @endif
                            @if(in_array('Taxes',$authorities))
                            <li>
                                <a href="{{url('tax/taxlisting')}}">Taxes</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    {{-- purchase info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Voucher Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Voucher',$authorities))
                            <li>
                                <a href="{{url('voucher/voucherlisting')}}">Voucher</a>
                            </li>
                            @endif
                            @if(in_array('Voucher Ledger',$authorities))
                            <li>
                                <a href="{{url('ledger/voucherhistory')}}" target="_blank">Voucher Ledger</a>
                            </li>
                            @endif
                            @if(in_array('Voucher Payable',$authorities))
                            <li>
                                <a target="_blank" href="{{url('invoice/amountpayable')}}">Voucher Payable</a>
                            </li>
                            @endif
                            @if(in_array('Direct In',$authorities))
                            <li>
                                <a href="{{url('voucher/directin')}}">Direct In</a>
                            </li>
                            @endif
                            @if(in_array('Add Suppliers',$authorities))
                            <li>
                                <a href="{{url('supplier/supplierlisting')}}"> Add Suppliers</a>
                            </li>
                            @endif
                            @if(in_array('Opening Suppliers',$authorities))
                            <li>
                                <a href="{{url('opening/supplier')}}">Opening Suppliers</a>
                            </li>
                            @endif
                            @if(in_array('Supplier Ledger',$authorities))
                            <li>
                                <a href="{{url('ledger/supplierhistory')}}" target="_blank">Supplier Ledger</a>
                            </li>
                            @endif
                            @if(in_array('Supplier Payable',$authorities))
                            <li>
                                <a href="{{url('invoice/supplierpayable')}}">Supplier Payable</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    {{-- Sale info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Sale Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Add Receipt',$authorities))
                            <li>
                                <a href="{{url('sale/saleorder')}}">Add Receipt</a>
                            </li>
                            @endif
                            @if(in_array('Receipt Ledger',$authorities))
                            <li>
                                <a href="{{url('ledger/receiptledger')}}" target="_blank">Receipt ledger</a>
                            </li>
                            @endif
                            @if(in_array('Receipt Receivable',$authorities))
                            <li>
                                <a href="{{url('invoice/amountreceivable')}}" target="_blank">Receipt Receivable</a>
                            </li>
                            @endif
                            @if(in_array('Direct Out',$authorities))
                            <li>
                                <a href="{{url('sale/directout')}}">Direct Out</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Customer<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Add Customers',$authorities))
                            <li>
                                <a href="{{url('customer/customerlisting')}}">Add Customers</a>
                            </li>
                            @endif
                            @if(in_array('Opening Customers',$authorities))
                            <li>
                                <a href="{{url('opening/customer')}}">Opening Customers</a>
                            </li>
                            @endif
                            @if(in_array('Customer Ledger',$authorities))
                            <li>
                                <a href="{{url('ledger/customerledger')}}" target="_blank">Customer Ledger</a>
                            </li>
                            @endif
                            @if(in_array('Customer Receivable',$authorities))
                            <li>
                                <a href="{{url('invoice/customerreceivable')}}">Customer Receivable</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    {{-- Payment info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Payment Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Payments',$authorities))
                            <li>
                                <a href="{{url('payment/paymentlisting')}}">Payments</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    {{-- Account info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Account Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Accounts',$authorities))
                            <li>
                                <a href="{{url('opening/accountlisting')}}">Accounts</a>
                            </li>
                            @endif
                            @if(in_array('Cash Deposit',$authorities))
                            <li>
                                <a href="{{url('opening/cashdeposit')}}">Cash Deposit/Withdraw</a>
                            </li>
                            @endif
                            @if(in_array('Accounts Ledger',$authorities))
                            <li>
                                <a href="{{url('ledger/accountledgerform')}}">Accounts Ledger</a>
                            </li>
                            @endif
                            @if(in_array('Financial Year',$authorities))
                            <li>
                                <a href="{{url('payment/financialyear')}}">Financial Year</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Expenditure<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('Heads',$authorities))
                            <li>
                                <a href="{{url('expenditure/headlisting')}}">Heads</a>
                            </li>
                            @endif
                            @if(in_array('Months',$authorities))
                            <li>
                                <a href="{{url('expenditure/monthlisting')}}">Months</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                   {{--  <li>
                        <a href="{{url('country/countrylisting')}}"><i class="fa fa-flag fa-fw"></i> Countries</a>
                    </li> --}}
                    @if(in_array('User management',$authorities) || \Auth::user()->type == 'superadmin')
                    <li>
                        <a href="{{ route('user_mangement_homepanel') }}"><i class="fa fa-users fa-fw"></i> User & Role Mangement </a>
                    </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>
@endsection