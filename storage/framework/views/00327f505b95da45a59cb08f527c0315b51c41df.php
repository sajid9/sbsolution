<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Taxes'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Tax
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('tax/addtax')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="taxname">Tax Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="<?php echo e(old('tax_name')); ?>" class="form-control" id="taxname" aria-describedby="taxname" placeholder="Tax Name">
    <small id="taxname" class="form-text text-muted text-danger"><?php echo e($errors->first('tax_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" id="price" aria-describedby="price" placeholder="Tax Price" value="<?php echo e(old('price')); ?>">
    <small id="price" class="form-text text-muted text-danger"><?php echo e($errors->first('price')); ?></small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('tax/taxlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/taxes/add_tax_form.blade.php ENDPATH**/ ?>