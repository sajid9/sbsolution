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
		        Delivered Item Detail
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <?php if($received_item->type == 'tile'): ?>
			                <th>Boxes</th>
			                <th>Pieces</th>
			                <th>Meter</th>
			                <?php endif; ?>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php 
				        	if($received_item->type == 'tile'){
				        		$obj = CH::convert_box($received_item->qty,$received_item->pieces,$received_item->meter);
				        	}
			        	?>
			            <tr class="odd gradeX">
			                <td>1</td>
			                <td><?php echo e($received_item->voucher_no); ?></td>
			                <td><?php echo e($received_item->item_name); ?></td>
			                <td><?php echo e($received_item->qty); ?></td>
			                <?php if($received_item->type == 'tile'): ?>
			                <td><?php echo e($obj['boxes']); ?></td>
			                <td><?php echo e($obj['pieces']); ?></td>
			                <td><?php echo e($obj['meter']); ?></td>
			                <?php endif; ?>
			            </tr>
			        </tbody>
			    </table>
		</div>
		
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
			                <td><?php echo e($item->voucher->voucher_no); ?></td>
			                <td><?php echo e($item->item->item_name); ?></td>
			                <?php if($item->item->type == 'tile'): ?>
			                <td><?php echo e(($item->return_item->returnitem != null) ? ($item->purchase - $item->return_item->returnitem) / $item->item->pieces : $item->purchase / $item->item->pieces); ?></td>
			                <?php else: ?>
			                <td><?php echo e(($item->return_item->returnitem != null) ? ($item->purchase - $item->return_item->returnitem) : $item->purchase); ?></td>
			                <?php endif; ?>
			                <td><?php echo e($item->storeobj->name); ?></td>
			                <?php if($item->item->type == 'tile'): ?>
			                <td><i class="glyphicon glyphicon-share" onclick="returnItem('<?php echo e($item->id); ?>','<?php echo e($item->voucher_id); ?>','<?php echo e($item->item_id); ?>','<?php echo e(($item->return_item->returnitem != null) ? ($item->purchase - $item->return_item->returnitem) / $item->item->pieces : $item->purchase / $item->item->pieces); ?>','<?php echo e(Request::segment(6)); ?>','<?php echo e($item->store); ?>')"></i></td>
			                <?php else: ?>
			                 <td><i class="glyphicon glyphicon-share" onclick="returnItem('<?php echo e($item->id); ?>','<?php echo e($item->voucher_id); ?>','<?php echo e($item->item_id); ?>','<?php echo e(($item->return_item->returnitem != null) ? ($item->purchase - $item->return_item->returnitem) : $item->purchase); ?>','<?php echo e(Request::segment(6)); ?>','<?php echo e($item->store); ?>')"></i></td>
			                <?php endif; ?>
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
            <input type="hidden" name="parent_id" id="parent_id">
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="item_id" id="item_id">
            <input type="hidden" name="receiving_id" id="receiving_id">
            <input type="hidden" name="store" id="store">
            <div class="form-group">
              <label for="t_qty">Total Quantity</label>
              <input type="number" name="total_quantity" disabled="disabled" class="form-control" id="t_qty">
            </div>
            <div class="form-group">
              <label for="return_pieces">Returned Quantity</label>
              <input type="number" disabled="disabled" value="" class="form-control" id="return_pieces">
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
	          var qty = parseInt($('#qty').val()) + parseInt($('#return_pieces').val());
	          if(qty > total_qty){
	            $('#qty_msg').text('Quantity should be less then total quantity');
	            $('#qty_sub').prop('disabled',true);
	          }else{
	            $('#qty_msg').text('');
	            $('#qty_sub').prop('disabled',false);
	          }
	        })
	    });
	    function returnItem(parentId,voucherId,itemId,qty,receivingId,store){
    	  $('#returnItem').modal('show');
    	  $('#t_qty').val(qty);
    	  $('#voucher_id').val(voucherId);
    	  $('#item_id').val(itemId);
    	  $('#receiving_id').val(receivingId);
    	  $('#store').val(store);
    	  $('#parent_id').val(parentId);
    	  $.ajax({
    	  	url:"<?php echo e(url('voucher/getreturned')); ?>",
    	  	type:"post",
    	  	dataType:"json",
    	  	data:{_token:"<?php echo e(csrf_token()); ?>",voucher:voucherId,item:itemId,receiving_id:receivingId,parentId:parentId},
    	  	success:function(res){
    	  		var check = parseInt("<?php echo e($received_item->type); ?>");
    	  		var pieces = parseInt("<?php echo e($received_item->pieces); ?>");
    	  		if(check == 'tile' && res.total != null){
    	  			var returnitem = res.total / pieces;
     	  		}else{
     	  			var returnitem = 0;
     	  		}
     	  		if(check == 'item' && res.total != null){
    	  			var returnitem = res.total;
     	  		}else{
     	  			var returnitem = 0;
     	  		}
    	  		
    	  		$('#return_pieces').val(returnitem);
    	  	}
    	  });
    	}
    	$('#return_form').on('submit',function(e){
    	  e.preventDefault();
    	  var data = $(this).serialize();
    	  var qty = $('#qty').val();
    	  if(qty == '' || qty == 0){
    	  	alert('please fill the quantity field also quantity can not be zero');
    	  	return 0;
    	  }
    	  $.ajax({
    	    url:"<?php echo e(url('voucher/returnitem')); ?>",
    	    type:"post",
    	    dataType:"json",
    	    data:data,
    	    success:function(res){
    	      if(res.message == 'successfully'){
    	        $('#return_form')[0].reset();
    	        $('#returnItem').modal('hide');
    	        $.toast({
	                        heading: 'SUCCESS',
	                        text: 'Item Returned Successfully',
	                        icon: 'success',
	                        position: 'top-right', 
	                        loader: true,        // Change it to false to disable loader
	                        loaderBg: '#9EC600'  // To change the background
	                    })
    	      }
    	    }
    	  });
    	})
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