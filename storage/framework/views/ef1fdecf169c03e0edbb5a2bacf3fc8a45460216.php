<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Receipt Ledger'); ?>


<?php $__env->startSection('header'); ?>
	##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
	<!-- Social Buttons CSS -->
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-12">
		<form class="form-inline" method="post" action="<?php echo e(url('ledger/searchreceipt')); ?>">
			<?php echo csrf_field(); ?>
		  <div class="form-group">
		    <label for="receipt">Receipt</label>
		    <select class="items-dropdown form-control" name="receipt" id="receipt">
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="frm">From:</label>
		    <input type="date" class="form-control" id="frm" name="from">
		  </div>
		  <div class="form-group">
		    <label for="to">To:</label>
		    <input type="date" class="form-control" id="to" name="to">
		  </div>
		  <button type="submit" class="btn btn-default">Search</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Voucher Ledger
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Date</th>
			                <th>receipt</th>
			                <th>Type</th>
			                <th>Debit</th>
			                <th>Credit</th>
			                <th>Balance</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	<?php $__currentLoopData = $ledgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        	<tr>
			        		<td><?php echo e(++$count); ?></td>
			        		<td><?php echo e(date_format(date_create($ledger->created_at),"d M Y H:i:s")); ?></td>
			        		<td><?php echo e($ledger->receipt_id); ?></td>
			        		<td><?php echo e($ledger->type); ?></td>
			        		<td><?php echo e($ledger->debit); ?></td>
			        		<td><?php echo e($ledger->credit); ?></td>
			        		<td><?php echo e($ledger->balance); ?></td>
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
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script>
	    $(document).ready(function() {
	        $('#dataTables-example').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
         	            'copy', 'csv', 'excel', 'pdf', 'print'
         	        ],
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	         $('.items-dropdown').select2({
	         	width: '200px',
	         	ajax: {
	         	    url: '<?php echo e(url("ledger/getreceipt")); ?>',
	         	    dataType: 'json',
	         	    processResults: function (data) {
         	          	return {
         	            	"results": data
         	          	};
	         	    }
	         	  }
	         });
	    });
	    function deleteItem(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '<?php echo e(url('item/deleteitem')); ?>';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>