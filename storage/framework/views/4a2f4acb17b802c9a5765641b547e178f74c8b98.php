<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Account Ledger'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-12">
				
		<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Account ledger
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Account</th>
			                <th>Supplier</th>
			                <th>Voucher</th>
			                <th>Customer</th>
			                <th>Receipt</th>
			                <th>Type</th>
			                <th>Debit</th>
			                <th>Credit</th>
			                <th>Date</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<tr>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td>Opening Balance:</td>
			        		<td><?php echo e($account->balance); ?></td>
			        		<td></td>
			        		<td></td>
			        	</tr>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <tr class="odd gradeX">
			                <td><?php echo e(++$count); ?></td>
			                <td><?php echo e(($payment->account != null) ? $payment->account->account_title : "null"); ?></td>
			                <td><?php echo e(($payment->supplier != null) ? $payment->supplier->supplier_name : "null"); ?></td>
			                <td><?php echo e(($payment->voucher != null) ? $payment->voucher->voucher_no : "null"); ?></td>
			                <td><?php echo e(($payment->customer != null) ? $payment->customer->customer_name : "null"); ?></td>
			                <td><?php echo e(($payment->receipt != null) ? $payment->receipt->receipt_no : "null"); ?></td>
			                <td><?php echo e($payment->type); ?></td>
			                <td><?php echo e($payment->debit); ?></td>
			                <td><?php echo e($payment->credit); ?></td>
			                <td><?php echo e(date_format($payment->created_at,'d M Y')); ?></td>
			                <td><a href="<?php echo e(url('payment/editpayment/'.$payment->id)); ?>"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></td>
			                
			            </tr>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			            <tr>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td>Net Balance:</td>
			        		<td><?php echo e((sizeof($payments) > 0) ? $payments[0]->account->balance - $total->total : $account->balance); ?></td>
			        		<td></td>
			        		<td></td>
			        	</tr>
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
	        $('#dataTables-example').DataTable({
	                responsive: true
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deletepayment(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '<?php echo e(url('payment/deletecategory')); ?>';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>