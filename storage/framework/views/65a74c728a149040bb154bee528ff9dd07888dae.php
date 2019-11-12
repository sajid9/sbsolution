<?php $__env->startSection('sidebar'); ?>
   <br />

            <!-- sidebar menu -->
   
   <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo e(url('/')); ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo e(@$company->name); ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo e(asset('images/user.png')); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo e(Auth::user()->name); ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <?php 
                if(CH::getauthorities() != null){
                    $authorities = CH::getauthorities()->authority; 
                }else{
                    $authorities = array();
                }
            ?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-table"></i> Items Info <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
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
                            <?php if(in_array('Companies',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('company/companylisting')); ?>"> Companies</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Classes',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('class/classlisting')); ?>">Classes</a>
                            </li>
                            <?php endif; ?>
                            <?php if(in_array('Taxes',$authorities)): ?>
                            <li>
                                <a href="<?php echo e(url('tax/taxlisting')); ?>">Taxes</a>
                            </li>
                            <?php endif; ?>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-home"></i> Voucher Info <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
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
                  <li><a><i class="fa fa-edit"></i> Sale Info <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">
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
                  <li><a><i class="fa fa-bar-chart-o"></i> Payment Info <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <?php if(in_array('Payments',$authorities)): ?>
                        <li>
                            <a href="<?php echo e(url('payment/paymentlisting')); ?>">Payments</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Account Info <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
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
                  <li><a><i class="fa fa-clone"></i>Expenditure <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
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
                  <li><a href="<?php echo e(route('user_mangement_homepanel')); ?>"><i class="fa fa-clone"></i>User & Role Mangement</a>
                  </li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
          
            <!-- /sidebar menu -->
<?php $__env->stopSection(); ?><?php /**PATH D:\xampp\htdocs\sbsolution\resources\views/includes/sidebar2.blade.php ENDPATH**/ ?>