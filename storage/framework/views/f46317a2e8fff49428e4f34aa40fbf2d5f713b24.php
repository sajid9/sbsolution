<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Sale Order'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row" style="padding-bottom: 10px">
	<div class="col-md-12">
		<a href="<?php echo e(url('sale/addreceiptform')); ?>" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Receipt
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
				
		<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Receipt Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-voucher">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Receipt No</th>
			                <th>Customer</th>
			                <th>Total Amount</th>
			                <th>Paid Amount</th>
			                <th>Return Amount</th>
			                <th>Balance Amount</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <tr class="odd gradeX">
			                <td><?php echo e(++$count); ?></td>
			                <td><?php echo e($receipt->receipt_no); ?></td>
			                <td><?php echo e($receipt->customer_id); ?></td>
			                <td><?php echo e($receipt->total_amount); ?></td>
			                <td><?php echo e($receipt->paid_amount); ?></td>
			                <td><?php echo e($receipt->return_amount); ?></td>
			                <td><?php echo e($receipt->total_amount - ($receipt->paid_amount + $receipt->return_amount)); ?></td>
			                <td><a class="btn btn-xs btn-primary" href="<?php echo e(url('invoice/sale/'.$receipt->id)); ?>"><i class="fa fa-print" title="Print" data-toggle="tooltip"></i></a> <a class="btn btn-xs btn-warning" href="<?php echo e(url('sale/editreceipt/'.$receipt->id)); ?>"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a></td>
			                
			            </tr>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </tbody>
			    </table>
		</div>
	</div>
	</div>
</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer'); ?>
	##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
	<!-- DataTables JavaScript -->
	<script src="<?php echo e(asset('js/dataTables/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
	<script>
	    $(document).ready(function() {
	        $('#dataTables-voucher').DataTable({
	                responsive: true,
	                columnDefs: [ { orderable: false, targets: [7] } ]
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/sale/sale_listing.blade.php ENDPATH**/ ?>