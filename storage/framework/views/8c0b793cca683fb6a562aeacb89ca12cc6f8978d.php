<?php $__env->startSection('title', 'Voucher Receiving'); ?>
<?php $__env->startSection('pagetitle', 'Voucher Receiving'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row" style="padding-bottom: 10px">
	<div class="col-md-12">
		<a href="<?php echo e(url('voucher/editvoucher/'.Request::segment(3))); ?>" class="btn btn-default">Back</a>
		<a href="<?php echo e(url('voucher/add_receiving_form/'.Request::segment(3).'/'.Request::segment(4))); ?>" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Receiving
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
				
		<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Item Detail
		    </div>
		    <div class="panel-body">
		    	<table class="table table-striped table-bordered table-hover" >
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <?php if($item_s->type == 'tile'): ?>
			                <th>Boxes</th>
			                <th>Pieces</th>
			                <th>Meter</th>
			                <?php endif; ?>
			                <th>Date</th>
			            </tr>
			        </thead>
			        <tbody>
			            <tr class="odd gradeX">

			            	<?php 
			            	if($item_s->type == 'tile'){
			            		$obj = CH::convert_box($item_s->qty,$item_s->pieces,$item_s->meter);
			            	}?>
			            	
			                <td>1</td>
			                <td><?php echo e($item_s->voucher_no); ?></td>
			                <td><?php echo e($item_s->item_name); ?></td>
			                <td><?php echo e($item_s->qty); ?></td>
			                <?php if($item_s->type == 'tile'): ?>
			                <td><?php echo e($obj['boxes']); ?></td>
			                <td><?php echo e($obj['pieces']); ?></td>
			                <td><?php echo e($obj['meter']); ?></td>
			                <?php endif; ?>
			                <td><?php echo e($item_s->created_at); ?></td>
			            </tr>
			            
			        </tbody>
			    </table>
			</div>
		</div>
		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Receiving Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <th>Date</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $receivings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receiving): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <tr class="odd gradeX">
			                <td><?php echo e(++$count); ?></td>
			                <td><?php echo e($receiving->voucher->voucher_no); ?></td>
			                <td><?php echo e($receiving->item->item_name); ?></td>
			                <td><?php echo e(($receiving->item->type == 'tile')? $receiving->qty / $receiving->item->pieces : $receiving->qty); ?></td>
			                <td><?php echo e($receiving->date); ?></td>
			                <td><a href="<?php echo e(url('voucher/receivingstore/'.$receiving->voucher_id.'/'.$receiving->item_id.'/'.$receiving->qty.'/'.$receiving->id)); ?>"><i class="fa fa-plus" title="Add to Store" data-toggle="tooltip"></i></a> </td>
			                
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
	        $('#dataTables-example').DataTable({
	                responsive: true
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deletestore(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '<?php echo e(url('group/deletegroup')); ?>';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/purchase/voucher_receiving/receiving_listing.blade.php ENDPATH**/ ?>