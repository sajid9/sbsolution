<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Payment'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Payment
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('payment/addpaymentsale')); ?>">
	<?php echo csrf_field(); ?>
  <input type="hidden" name="receipt" value="<?php echo e($receipt->id); ?>">
  <div class="form-group">
    <label for="receipt_no">Receipt No</label>
    <input type="text" value="<?php echo e($receipt->receipt_no); ?>" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="receipt_no">Customer</label>
    <input type="hidden" name="customer" value="<?php echo e($customer->id); ?>">
    <input type="text" value="<?php echo e($customer->customer_name); ?>" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="receipt_no">Total Amount</label>
    <input type="number" value="<?php echo e($total); ?>" readOnly class="form-control" id="total_amount">
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" name="amount" value="<?php echo e(old('amount')); ?>" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
    <small id="amount_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('amount')); ?></small>
  </div>
  <div class="form-group">
    <label for="account">Account</label>
    <select name="account" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
       <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_title); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="account_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('account')); ?></small>
  </div>
  <div class="form-group">
    <label for="pay_type">Payment Through</label>
    <select name="pay_type" class="form-control" id="pay_type" aria-describedby="pay_type_msg">
      <option value=""> Select Payment Type</option>
      <option>cash</option>
      <option>debit card</option>
      <option>check</option>
      <option>other</option>
    </select>
    <small id="pay_type_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('pay_type')); ?></small>
  </div>
  <div class="form-group">
    <label for="fn_year">Fianancial Year</label>
    <select name="fn_year" class="form-control" id="fn_year" aria-describedby="fn_year">
      <option value=""> Select Fianancial Year</option>
      <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option><?php echo e($year->year); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="fn_year" class="form-text text-muted text-danger"><?php echo e($errors->first('fn_year')); ?></small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('payment/paymentlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script type="text/javascript">
  $('#amount').on('blur',function(){
    
    var total  = parseInt($('#total_amount').val());
    var amount = parseInt($(this).val());
    if(amount > total){
      alert('Amount should be less then total amount.Total amount is '+total);
      $(this).val('');
    }
  })

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>