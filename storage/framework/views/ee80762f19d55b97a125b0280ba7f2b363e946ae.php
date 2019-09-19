<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Catgeory'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Catgeory
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('category/updatecategory')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="categoryname">category Name <span class="text-danger">*</span></label>
    <input type="text" name="category_name" value="<?php echo e($category->category_name); ?>" class="form-control" id="categoryname" aria-describedby="categoryname" placeholder="category Name">
    <input type="hidden" name="id" value="<?php echo e($category->id); ?>">
    <small id="categoryname" class="form-text text-muted text-danger"><?php echo e($errors->first('category_name')); ?></small>
  </div>
  
  <div class="form-group">
    <label for="discription">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description',$category->description)); ?></textarea>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($category->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('category/categorylisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>