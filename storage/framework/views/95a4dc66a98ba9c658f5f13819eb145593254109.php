<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Head'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row" style="padding-bottom: 10px">
	<div class="col-md-12">
		<a href="<?php echo e(url('expenditure/addhead')); ?>" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Head
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
				
		<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Head Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>name</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $heads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <tr class="odd gradeX">
			                <td><?php echo e(++$count); ?></td>
			                <td><?php echo e($head->name); ?></td>
			                <td><?php echo ($head->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">unactive</span>'; ?></td>
			                <td><a href="<?php echo e(url('expenditure/edithead/'.$head->id)); ?>"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> <a href="<?php echo e(url('expenditure/subheadlisting/'.$head->id)); ?>"><i class="fa fa-plus" data-toggle="tooltip" title="Add Subhead"></i></a></td>
			                
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
	    function deleteCompany(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '<?php echo e(url('company/deletecompany')); ?>';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>