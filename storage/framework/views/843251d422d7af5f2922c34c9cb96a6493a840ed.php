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
                    <?php 
                        if(CH::getauthorities() != null){
                            $authorities = CH::getauthorities()->authority; 
                        }else{
                            $authorities = array();
                        }
                    ?>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Items Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('Add Item',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('item/itemlisting')); ?>">Add Item</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Opening item',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('opening/addItem')); ?>">Opening Item</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Item Ledger',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('ledger/itemledger')); ?>">Item Ledger</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Stock Report',$authorities)): ?>
                            <li>
                                <a target="_blank" href="<?php echo e(url('ledger/stockreport')); ?>">Stock Report</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Stores',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('store/storelisting')); ?>">Stores</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Groups',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('group/grouplisting')); ?>">Groups</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Measuring Unit',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('measuring/unitlisting')); ?>">Measuring Unit</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Sizes',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('size/sizelisting')); ?>">Sizes</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Companies',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('company/companylisting')); ?>"> Companies</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Categories',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('category/categorylisting')); ?>">Categories</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Classes',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('class/classlisting')); ?>">Classes</a>
                            </li>
                           <?php endif; ?>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Voucher Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('Voucher',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('voucher/voucherlisting')); ?>">Voucher</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Voucher Ledger',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('ledger/voucherhistory')); ?>" target="_blank">Voucher Ledger</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Voucher Payable',$authorities)): ?>
                            <li>
                                <a target="_blank" href="<?php echo e(url('invoice/amountpayable')); ?>">Voucher Payable</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Direct In',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('voucher/directin')); ?>">Direct In</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Add Suppliers',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('supplier/supplierlisting')); ?>"> Add Suppliers</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Opening Suppliers',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('opening/supplier')); ?>">Opening Suppliers</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Supplier Ledger',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('ledger/supplierhistory')); ?>" target="_blank">Supplier Ledger</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Supplier Payable',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('invoice/supplierpayable')); ?>">Supplier Payable</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Sale Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('Add Receipt',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('sale/saleorder')); ?>">Add Receipt</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Receipt Ledger',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('ledger/receiptledger')); ?>" target="_blank">Receipt ledger</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Receipt Receivable',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('invoice/amountreceivable')); ?>" target="_blank">Receipt Receivable</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Direct Out',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('sale/directout')); ?>">Direct Out</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Add Customers',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('customer/customerlisting')); ?>">Add Customers</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Opening Customers',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('opening/customer')); ?>">Opening Customers</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Customer Ledger',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('ledger/customerledger')); ?>" target="_blank">Customer Ledger</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Customer Receivable',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('invoice/customerreceivable')); ?>">Customer Receivable</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Payment Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('Payments',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('payment/paymentlisting')); ?>">Payments</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Account Info<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('Accounts',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('opening/accountlisting')); ?>">Accounts</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Cash Deposit',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('opening/cashdeposit')); ?>">Cash Deposit/Withdraw</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Accounts Ledger',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('ledger/accountledgerform')); ?>">Accounts Ledger</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Financial Year',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('payment/financialyear')); ?>">Financial Year</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-fw"></i> Expenditure<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if(in_array('Heads',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('expenditure/headlisting')); ?>">Heads</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Months',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('expenditure/monthlisting')); ?>">Months</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                   
                    <?php if(in_array('User management',$authorities) || \Auth::user()->type == 'superadmin'): ?>
                    <li>
                        <a href="<?php echo e(route('user_mangement_homepanel')); ?>"><i class="fa fa-users fa-fw"></i> User & Role Mangement </a>
                    </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
<?php $__env->stopSection(); ?>