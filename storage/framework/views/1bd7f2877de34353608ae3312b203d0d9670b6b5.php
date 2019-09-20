<?php $__env->startSection('title', 'Deposit / withdraw'); ?>
<?php $__env->startSection('pagetitle', 'Cash Deposit / Withdraw'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Cash Deposit / Withdraw
</div>
<div class="panel-body">
<?php if(Session::has('message')): ?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong>Record Added Successfully
</div>
<?php endif; ?>

<form method="post" action="<?php echo e(url('opening/savedeposit')); ?>">
	<?php echo csrf_field(); ?>
  
  <div class="row">
      <div class="form-group col-md-4">
        <label for="account">Account<span class="text-danger">*</span></label>
        <select tabindex="1"  name="account" class="form-control" id="account" aria-describedby="account_msg">
          <option value="">Select Account</option>
          <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_title); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="account_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('account')); ?></small>
      </div>
      <div class="form-group col-md-4">
        <label for="amount">Amount <span class="text-danger">*</span></label>
        <input type="number" tabindex="2"  name="amount" value="<?php echo e(old('amount')); ?>" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
        <small id="amount_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('amount')); ?></small>
      </div>
      <div class="form-group col-md-4">
        <label for="type">Account<span class="text-danger">*</span></label>
        <select tabindex="1"  name="type" class="form-control" id="type" aria-describedby="type_msg">
          <option value="">Select type</option>
          <option value="withdraw">Cash Withdraw</option>
          <option value="deposit">Cash Deposit</option>
          
        </select>
        <small id="type_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('type')); ?></small>
      </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
        <label for="date">Date<span class="text-danger">*</span></label>
        <input type="date" tabindex="3"  name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="enter the date">
        <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
      </div>
    <div class="form-group col-md-4">
      <label for="remarks">Remarks<span class="text-danger">*</span></label>
      <textarea tabindex="4"  name="remarks" class="form-control" id="remarks" aria-describedby="remarks_msg"><?php echo e(old('date')); ?></textarea>
      <small id="remarks_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('remarks')); ?></small>
    </div>
    <div class="col-md-4" style="padding-top: 35px;">
      <button type="submit" tabindex="5" class="btn btn-primary">submit</button> <a href="<?php echo e(url('opening/accountlisting')); ?>" tabindex="6" class="btn btn-default">Back</a>
    </div>
  </div>
  
  
</form>


</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>