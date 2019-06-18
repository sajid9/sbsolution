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
                    <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                    <li>
                        <a href="{{url('company/companylisting')}}"><i class="fa fa-building fa-fw"></i> Companies</a>
                    </li>
                    <li>
                        <a href="{{url('category/categorylisting')}}"><i class="fa fa-list fa-fw"></i> Categories</a>
                    </li>
                    <li>
                        <a href="{{url('class/classlisting')}}"><i class="fa fa-sitemap fa-fw"></i> Classes</a>
                    </li>
                    <li>
                        <a href="{{url('supplier/supplierlisting')}}"><i class="fa fa-industry fa-fw"></i> Suppliers</a>
                    </li>
                    <li>
                        <a href="{{url('customer/customerlisting')}}"><i class="fa fa-group fa-fw"></i> Customers</a>
                    </li>
                    <li>
                        <a href="{{url('country/countrylisting')}}"><i class="fa fa-flag fa-fw"></i> Countries</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Items <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('item/itemlisting')}}">Add Item</a>
                            </li>
                            <li>
                                <a href="{{url('voucher/voucherlisting')}}">Purchase Order</a>
                            </li>
                            <li>
                                <a href="{{url('sale/saleorder')}}">Sale Order</a>
                            </li>
                            <li>
                                <a href="{{url('payment/paymentlisting')}}">Payments</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/itemledger')}}">Item Ledger</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/voucherhistory')}}">Voucher History</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/supplierhistory')}}">Supplier History</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/customerledger')}}">Customer ledger</a>
                            </li>
                            <li>
                                <a href="{{url('ledger/receiptledger')}}">Receipt ledger</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
@endsection