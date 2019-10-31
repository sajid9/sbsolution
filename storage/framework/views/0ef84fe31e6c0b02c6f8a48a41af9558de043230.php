<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Item'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-5">
				<form id="fileUploadForm" method="POST" action="<?php echo e(url('importCsv')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
				    <fieldset>
				        <div class="form-horizontal">
				            <div class="form-group">
				                <div class="row">
				                <label class="control-label col-md-3 text-right" for="filename"><span>Import Items</span></label>
				                <div class="col-md-9">
				                    <div class="input-group">
				                        <input type="file" id="uploadedFile" name="file" class="form-control form-control-sm" accept=".csv">
				                        <div class="input-group-btn">
				                            <input type="submit" value="Import" class="rounded-0 btn btn-primary">
				                        </div>
				                    </div>
				                </div>
				                </div>
				            </div>                        
				        </div>
				    </fieldset>    
				</form>
			</div>
			<div class="col-md-2">
				<a class="btn btn-sm btn-warning" href="<?php echo e(asset('images/items_pattern.csv')); ?>">Check Pattern</a>
			</div>
			<div class="col-md-2 col-md-offset-3">
				<a href="<?php echo e(url('item/additemform')); ?>" class="btn btn-social btn-bitbucket pull-right">
				    <i class="fa fa-plus"></i> Add Item
				</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
				
		<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Item Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>item Name</th>
			                <th>Barcode</th>
			                <th>Purchase Price</th>
			                <th>Sale Price</th>
			                <th>Type</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <tr class="odd gradeX">
			                <td><?php echo e(++$count); ?></td>
			                <td><?php echo e($item->item_name); ?></td>
			                <td><?php echo e($item->barcode); ?></td>
			                <td><?php echo e($item->purchase_price); ?></td>
			                <td><?php echo e($item->sale_price); ?></td>
			                <td><?php echo e($item->type); ?></td>
			                <td><?php echo ($item->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">inactive</span>'; ?></td>
			                <td><a class="btn btn-xs btn-warning" href="<?php echo e(url('item/edititem/'.$item->id)); ?>"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> </td>
			                
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
	                responsive: true,
	                columnDefs: [ { orderable: false, targets: [7] } ]
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deleteItem(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '<?php echo e(url('item/deleteitem')); ?>';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/items/item_listing.blade.php ENDPATH**/ ?>