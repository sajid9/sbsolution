<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Account Ledger'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Account Ledger
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('ledger/accountledger')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account_id" class="form-control" id="account" aria-describedby="account">
      <option value="">Select Account</option>
      <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_title); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="account" class="form-text text-muted text-danger"><?php echo e($errors->first('account_id')); ?></small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>