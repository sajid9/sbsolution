<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Opening Customer'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Opening Customer
</div>
<div class="panel-body">
<div class="alert alert-success alert-dismissible" id="alert" style="display: none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Record Added Successfully
</div>

<form id="supplierForm">
	<?php echo csrf_field(); ?>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="customer">customer <span class="text-danger">*</span></label>
          <select name="customer" class="form-control" id="customer" aria-describedby="customer_msg">
            <option value="">Select customer </option>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->customer_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        <small id="customer_msg" class="form-text text-muted text-danger"></small>
      </div>
      <div class="form-group">
        <label for="amount">Amount <span class="text-danger">*</span></label>
        <input type="number"  name="amount" value="<?php echo e(old('amount')); ?>" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
        <small id="amount_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select name="type" class="form-control" id="type" aria-describedby="type_msg">
          <option value="">Select Type</option>
          <option value="debit">Debit</option>
          <option value="credit">Credit</option>
        </select>
        <small id="type_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">submit</button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
  $('#supplierForm').on('submit',function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      url:"<?php echo e(url('opening/savecustomer')); ?>",
      data:data,
      type:"post",
      dataType:"json",
      success:function(res){
        $('#alert').css('display','block');
        document.getElementById("supplierForm").reset();
      }
    });
  })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>