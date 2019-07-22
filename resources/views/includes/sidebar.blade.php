@section('sidebar')
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">SB Software Solution</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        {{-- <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul> --}}

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            {{-- <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                    
                    {{-- Item Info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Items Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('item/itemlisting')}}">Add Item</a>
                            </li>
                            <li>
                                <a href="{{url('opening/addItem')}}">Opening Item</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/itemledger')}}">Item Ledger</a>
                            </li>
                            <li>
                                <a href="{{url('store/storelisting')}}">Stores</a>
                            </li>
                            <li>
                                <a href="{{url('company/companylisting')}}"> Companies</a>
                            </li>
                            <li>
                                <a href="{{url('category/categorylisting')}}">Categories</a>
                            </li>
                            <li>
                                <a href="{{url('class/classlisting')}}">Classes</a>
                            </li>
                            <li>
                                <a href="{{url('expenditure/headlisting')}}">Heads</a>
                            </li>
                            <li>
                                <a href="{{url('expenditure/monthlisting')}}">Months</a>
                            </li>
                        </ul>
                    </li>
                    {{-- purchase info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Purchase Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('voucher/voucherlisting')}}">Purchase Order</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/voucherhistory')}}">Voucher History</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/supplierhistory')}}">Supplier History</a>
                            </li>
                            <li>
                                <a href="{{url('supplier/supplierlisting')}}"> Add Suppliers</a>
                            </li>
                            <li>
                                <a href="{{url('opening/supplier')}}">Opening Supplier</a>
                            </li>
                            <li>
                                <a target="_blank" href="{{url('invoice/amountpayable')}}">Voucher Payable</a>
                            </li>
                            <li>
                                <a href="{{url('invoice/supplierpayable')}}">Supplier Payable</a>
                            </li>
                        </ul>
                    </li>
                    {{-- Sale info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Sale Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('sale/saleorder')}}">Sale Order</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/customerledger')}}">Customer ledger</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/receiptledger')}}">Receipt ledger</a>
                            </li>
                            <li>
                                <a href="{{url('customer/customerlisting')}}">Add Customers</a>
                            </li>
                            <li>
                                <a href="{{url('opening/customer')}}">opening Customer</a>
                            </li>
                            <li>
                                <a href="{{url('invoice/amountreceivable')}}">Receipt Receivable</a>
                            </li>
                            <li>
                                <a href="{{url('invoice/customerreceivable')}}">Customer Receivable</a>
                            </li>
                        </ul>
                    </li>
                    {{-- Payment info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Payment Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('payment/paymentlisting')}}">Payments</a>
                            </li>
                            <li>
                                <a href="{{url('payment/paymentlisting')}}">Payment Ledger</a>
                            </li>
                        </ul>
                    </li>
                    {{-- Account info --}}
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Account Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('opening/accountlisting')}}">Accounts</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/accountledgerform')}}">Accounts Ledger</a>
                            </li>
                            <li>
                                <a href="{{url('payment/financialyear')}}">Financial Year</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('country/countrylisting')}}"><i class="fa fa-flag fa-fw"></i> Countries</a>
                    </li>
                    
                </ul>

            </div>
        </div>
    </nav>
@endsection