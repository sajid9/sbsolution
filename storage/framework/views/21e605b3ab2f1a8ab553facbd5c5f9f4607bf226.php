<?php $__env->startSection('title', 'Voucher Receiving'); ?>
<?php $__env->startSection('pagetitle', 'Add to Stores'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row" style="padding-bottom: 10px">
	<div class="col-md-12">
		<a href="<?php echo e(url('voucher/receivinglisting/'.Request::segment(3).'/'.Request::segment(4))); ?>" class="btn btn-default">Back</a>
		<a href="<?php echo e(url('voucher/addreceivingstoreform/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6))); ?>" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Receiving to Stores
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
				
		<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Receiving Store Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <th>Store</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <tr class="odd gradeX">
			                <td><?php echo e(++$count); ?></td>
			                <td><?php echo e($item->voucher_id); ?></td>
			                <td><?php echo e($item->item_id); ?></td>
			                <td><?php echo e($item->purchase); ?></td>
			                <td><?php echo e($item->store); ?></td>
			                <td><i class="glyphicon glyphicon-share" onclick="returnItem('<?php echo e($item->voucher_id); ?>','<?php echo e($item->item_id); ?>','<?php echo e($item->purchase); ?>','<?php echo e($item->purchase_price); ?>')"></i></td>
			                
			            </tr>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </tbody>
			    </table>
		</div>
	</div>
	</div>
</div>
<div class="modal fade" id="returnItem" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <form id="return_form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="item_id" id="item_id">
            <input type="hidden" name="purchase_price" id="purchase_price_modal">
            <div class="form-group">
              <label for="t_qty">Total Quantity</label>
              <input type="number" name="total_quantity" disabled="disabled" class="form-control" id="t_qty">
            </div>
            <div class="form-group">
              <label for="qty">Quantity</label>
              <input type="number" name="quantity" class="form-control" id="qty" placeholder="Enter the quantity to return">
              <small id="qty_msg" class="form-text text-muted text-danger"></small>
            </div>
            <button type="submit" id="qty_sub" class="btn btn-default">Submit</button>
          </form>
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
	        $('#qty').on('keyup',function(){
	          var total_qty = parseInt($('#t_qty').val());
	          var qty = parseInt($('#qty').val());
	          if(qty > total_qty){
	            $('#qty_msg').text('Quantity should be less then total quantity');
	            $('#qty_sub').prop('disabled',true);
	          }else{
	            $('#qty_msg').text('');
	            $('#qty_sub').prop('disabled',false);
	          }
	        })
	    });
	    function returnItem(voucherId,itemId,qty,purchasePrice){
    	  $('#returnItem').modal('show');
    	  $('#t_qty').val(qty);
    	  $('#voucher_id').val(voucherId);
    	  $('#item_id').val(itemId);
    	  $('#purchase_price_modal').val(purchasePrice);
    	}
	    function deletestore(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '<?php echo e(url('group/deletegroup')); ?>';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>