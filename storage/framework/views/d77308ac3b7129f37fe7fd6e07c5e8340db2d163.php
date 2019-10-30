<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Edit Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Store
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('tax/updatetax')); ?>">
	<?php echo csrf_field(); ?>
  <input type="hidden" name="id" value="<?php echo e($tax->id); ?>">
  <div class="form-group">
    <label for="taxname">Tax Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="<?php echo e(old('tax_name',$tax->name)); ?>" class="form-control" id="taxname" aria-describedby="taxname" placeholder="Tax Name">
    <small id="taxname" class="form-text text-muted text-danger"><?php echo e($errors->first('tax_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" id="price" aria-describedby="price" placeholder="Tax Price" value="<?php echo e(old('price',$tax->price)); ?>">
    <small id="price" class="form-text text-muted text-danger"><?php echo e($errors->first('price')); ?></small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($tax->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('tax/taxlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/taxes/edit_tax_form.blade.php ENDPATH**/ ?>