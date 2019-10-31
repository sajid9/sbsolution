<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Dashboard'); ?>
<?php $__env->startSection('header'); ?>
##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/dncalendar-skin.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php 
    if(CH::getauthorities() != null){
        $authorities = CH::getauthorities()->authority; 
    }else{
        $authorities = array();
    }
?>
<?php if(in_array('Dashboard',$authorities)): ?>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo e(($payable != null) ? $payable->balance : 0); ?></div>
                        <div>Amount Payable</div>
                    </div>
                </div>
            </div>
            <a target="_blank" href="<?php echo e(url('invoice/amountpayable')); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo e(($receivable != null) ?$receivable->balance : 0); ?></div>
                        <div>Amount Receivable!</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(url('invoice/amountreceivable')); ?>" target="_blank">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo e(($totalpurchase != null) ?$totalpurchase->total : 0); ?></div>
                        <div>Total Purchase</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(url('voucher/voucherlisting')); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo e(($totalsale != null) ?$totalsale->total: 0); ?></div>
                        <div>Total Sale</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(url('sale/saleorder')); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-success">
          <div class="panel-heading">Alerts Low Stock</div>
          <div class="panel-body">
              <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Barcode</th>
                        <th>Item Name</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $lowstocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->barcode); ?></td>
                            <td><?php echo e($item->item_name); ?></td>
                            <td><?php echo e($item->qty); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div id="dn-calender"></div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script src="<?php echo e(asset('js/dncalendar.min.js')); ?>"></script>
<script>
    var my_calendar = $("#dn-calender").dnCalendar({
        dataTitles: { defaultDate: 'default', today : 'Today' },
        notes: [
          { "date": "2019-7-6", "note": ["Happy New Year 2016"] }
          ],
        showNotes: true,
    });
    my_calendar.build();

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/home.blade.php ENDPATH**/ ?>