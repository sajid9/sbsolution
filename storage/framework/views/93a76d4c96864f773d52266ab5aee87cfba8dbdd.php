<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Company Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
   Add / Edit Company Profile
</div>
<div class="panel-body">
<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(url('user/addcompanysetting')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="companyname">Company Name <span class="text-danger">*</span></label>
    <input type="hidden" name="id" value="<?php echo e(@$company->id); ?>">
    <input type="text" name="company_name" value="<?php echo e(old('company_name',@$company->name)); ?>" class="form-control" id="companyname" aria-describedby="companyname" placeholder="Company Name">
    <small id="companyname" class="form-text text-muted text-danger"><?php echo e($errors->first('company_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="email">Email <span class="text-danger">*</span></label>
    <input type="text" name="company_email" value="<?php echo e(old('company_email',@$company->email)); ?>" class="form-control" id="email" aria-describedby="email" placeholder="Email">
    <small id="email" class="form-text text-muted text-danger"><?php echo e($errors->first('company_email')); ?></small>
  </div>
  <div class="form-group">
    <label for="logo">Company Logo <span class="text-danger">*</span></label>
    <input type="file" name="company_logo"  class="form-control" id="logo" aria-describedby="logo" placeholder="Company Logo">
    <small id="logo" class="form-text text-muted text-danger"><?php echo e($errors->first('company_logo')); ?></small>
    <input type="hidden" name="old_logo" value="<?php echo e(@$company->logo); ?>">
    <?php if(isset($company->logo)): ?>
    <br>
    <img src="<?php echo e(env('APP_URL')); ?>/storage/app/<?php echo e($company->logo); ?>" width="100" height="100" alt="">
    <?php endif; ?>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="company_phone" value="<?php echo e(old('company_phone',@$company->phone)); ?>" class="form-control" id="phone" aria-describedby="phone" placeholder="Phone">
    <small id="phone" class="form-text text-muted text-danger"><?php echo e($errors->first('company_phone')); ?></small>
  </div>
  <div class="form-group">
    <label for="mobile">Mobile</label>
    <input type="text" name="company_mobile" value="<?php echo e(old('company_mobile',@$company->mobile)); ?>" class="form-control" id="mobile" aria-describedby="mobile" placeholder="Mobile">
    <small id="mobile" class="form-text text-muted text-danger"><?php echo e($errors->first('company_mobile')); ?></small>
  </div>
  <div class="form-group">
    <label for="website">Website</label>
    <input type="text" name="company_website" value="<?php echo e(old('company_website',@$company->website)); ?>" class="form-control" id="website" aria-describedby="website" placeholder="Website">
    <small id="website" class="form-text text-muted text-danger"><?php echo e($errors->first('company_website')); ?></small>
  </div>
  <div class="form-group">
    <label for="address">address</label>
    <textarea type="text" name="company_address"class="form-control" id="address" aria-describedby="address"><?php echo e(old('company_address',@$company->address)); ?></textarea>
    <small id="address" class="form-text text-muted text-danger"><?php echo e($errors->first('company_address')); ?></small>
  </div>
  
  <button type="submit" class="btn btn-primary"><?php echo e((isset($company->id)) ? 'Update' : 'Submit'); ?></button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/user/add_setting_form.blade.php ENDPATH**/ ?>