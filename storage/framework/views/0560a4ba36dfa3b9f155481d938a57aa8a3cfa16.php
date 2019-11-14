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
    <div class="col-md-12">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
              <div class="count"><?php echo e(($payable != null) ? $payable->balance : 0); ?></div>
              <h3>Payable</h3>
              <p><a target="_blank" href="<?php echo e(url('invoice/amountpayable')); ?>">Read More</a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-comments-o"></i></div>
              <div class="count"><?php echo e(($receivable != null) ?$receivable->balance : 0); ?></div>
              <h3>Receivable</h3>
              <p><a href="<?php echo e(url('invoice/amountreceivable')); ?>" target="_blank">Read More</a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
              <div class="count"><?php echo e(($totalpurchase->total != null) ? $totalpurchase->total : 0); ?></div>
              <h3>Purchase</h3>
              <p><a href="<?php echo e(url('voucher/voucherlisting')); ?>">Read More </a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-check-square-o"></i></div>
              <div class="count"><?php echo e(($totalsale->total != null) ? $totalsale->total: 0); ?></div>
              <h3>Sale</h3>
              <p><a href="<?php echo e(url('sale/saleorder')); ?>">Read More</a></p>
            </div>
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
        <div class="panel panel-success">
          <div class="panel-heading">Sale of the day</div>
          <div class="panel-body">
              <table class="table display" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Receipt No</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
          <div class="panel-heading">Expenditure of the day</div>
          <div class="panel-body">
            <table class="table display" id="exp_tbl" style="width: 100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                
              </table>
          </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script src="<?php echo e(asset('js/dncalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/dataTables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
   
  $(document).ready(function() {
      $('#example').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax": {
              "url": "<?php echo e(url('getsaleofday')); ?>",
              "type": "POST",
              "data":{_token:"<?php echo e(csrf_token()); ?>"}
          },
          "columns": [
              { "data": "id" },
              { "data": "receipt_no" },
              { "data": "total_amount" },
          ]
      } );
      $('#exp_tbl').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax": {
              "url": "<?php echo e(url('getexpofday')); ?>",
              "type": "POST",
              "data":{_token:"<?php echo e(csrf_token()); ?>"}
          },
          "columns": [
              { "data": "id" },
              { "data": "exp_desc" },
              { "data": "debit" },
          ]
      } );
  } );

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/home.blade.php ENDPATH**/ ?>