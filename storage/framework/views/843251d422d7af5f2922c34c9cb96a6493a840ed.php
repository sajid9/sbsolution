<?php $__env->startSection('sidebar'); ?>
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><?php echo e(@$company->name); ?></a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                    <?php echo e(Auth::user()->name); ?>

                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php echo e(url('user/profile')); ?>"><i class="fa fa-user fa-fw"></i> Profile</a>
                    </li>
                    <li><a href="<?php echo e(url('user/companysetting')); ?>"><i class="fa fa-building fa-fw"></i> Company Profile</a>
                    </li>
                    <li><a href="<?php echo e(url('user/changepassword')); ?>"><i class="fa fa-lock fa-fw"></i>Reset Password</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <a href="<?php echo e(url('/')); ?>" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Items Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo e(url('item/itemlisting')); ?>">Add Item</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('opening/addItem')); ?>">Opening Item</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('ledger/itemledger')); ?>">Item Ledger</a>
                            </li>
                            <li>
                                <a target="_blank" href="<?php echo e(url('ledger/stockreport')); ?>">Stock Report</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('store/storelisting')); ?>">Stores</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('group/grouplisting')); ?>">Groups</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('measuring/unitlisting')); ?>">Measuring Unit</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('size/sizelisting')); ?>">sizes</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('company/companylisting')); ?>"> Companies</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('category/categorylisting')); ?>">Categories</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('class/classlisting')); ?>">Classes</a>
                            </li>
                           
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Voucher Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo e(url('voucher/voucherlisting')); ?>">Voucher</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('ledger/voucherhistory')); ?>" target="_blank">Voucher ledger</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('ledger/supplierhistory')); ?>" target="_blank">Supplier ledger</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('supplier/supplierlisting')); ?>"> Add Suppliers</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('opening/supplier')); ?>">Opening Supplier</a>
                            </li>
                            <li>
                                <a target="_blank" href="<?php echo e(url('invoice/amountpayable')); ?>">Voucher Payable</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('invoice/supplierpayable')); ?>">Supplier Payable</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Sale Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo e(url('sale/saleorder')); ?>">Sale Order</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('ledger/customerledger')); ?>" target="_blank">Customer ledger</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('ledger/receiptledger')); ?>" target="_blank">Receipt ledger</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('customer/customerlisting')); ?>">Add Customers</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('opening/customer')); ?>">opening Customer</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('invoice/amountreceivable')); ?>" target="_blank">Receipt Receivable</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('invoice/customerreceivable')); ?>">Customer Receivable</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Payment Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo e(url('payment/paymentlisting')); ?>">Payments</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('payment/paymentlisting')); ?>">Payment Ledger</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Account Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo e(url('opening/accountlisting')); ?>">Accounts</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('ledger/accountledgerform')); ?>">Accounts Ledger</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('payment/financialyear')); ?>">Financial Year</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Expenditure<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo e(url('expenditure/headlisting')); ?>">Heads</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('expenditure/monthlisting')); ?>">Months</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo e(url('country/countrylisting')); ?>"><i class="fa fa-flag fa-fw"></i> Countries</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
<?php $__env->stopSection(); ?>