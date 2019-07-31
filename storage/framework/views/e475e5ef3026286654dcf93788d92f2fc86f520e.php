<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Add Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Item
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('item/additem')); ?>">
	<?php echo csrf_field(); ?>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="itemname">Item Name <span class="text-danger">*</span></label>
        <input type="text" name="item_name" value="<?php echo e(old('item_name')); ?>" class="form-control" id="itemname" aria-describedby="itemname" placeholder="item Name">
        <small id="itemname" class="form-text text-muted text-danger"><?php echo e($errors->first('item_name')); ?></small>
      </div>
      <div class="form-group">
        <label for="barcode">Barcode <span class="text-danger">*</span></label>
        <input type="text" name="barcode" value="<?php echo e(old('barcode')); ?>" class="form-control" id="barcode" placeholder="Short Code" aria-describedby="barcode">
        <small id="barcode" class="form-text text-muted text-danger"><?php echo e($errors->first('barcode')); ?></small>
      </div>
      <div class="form-group">
        <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
        <input type="number" name="purchase_price" value="<?php echo e(old('purchase_price')); ?>" class="form-control" id="purchase_price" placeholder="Short Code" aria-describedby="purchase_price">
        <small id="purchase_price" class="form-text text-muted text-danger"><?php echo e($errors->first('purchase_price')); ?></small>
      </div>
      <div class="form-group">
        <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
        <input type="number" name="sale_price" value="<?php echo e(old('sale_price')); ?>" class="form-control" id="sale_price" placeholder="Short Code" aria-describedby="sale_price">
        <small id="sale_price" class="form-text text-muted text-danger"><?php echo e($errors->first('sale_price')); ?></small>
      </div>
      <div class="form-group">
        <label for="discription">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description')); ?></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="store">Store </label>
        <select name="store" class="form-control" id="store" aria-describedby="store">
          <option value="">Select store</option>
          <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="store" class="form-text text-muted text-danger"><?php echo e($errors->first('store')); ?></small>
      </div>
      <div class="form-group">
        <label for="company">Company </label>
        <select name="company" class="form-control" id="company" aria-describedby="company">
          <option value="">Select Company</option>
          <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="company" class="form-text text-muted text-danger"><?php echo e($errors->first('company')); ?></small>
      </div>
      <div class="form-group">
        <label for="category">Category </label>
        <select name="category" class="form-control" id="category" aria-describedby="category">
          <option value="">Select Category</option>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="category" class="form-text text-muted text-danger"><?php echo e($errors->first('category')); ?></small>
      </div>
      <div class="form-group">
        <label for="class">Class </label>
        <select name="class" class="form-control" id="class" aria-describedby="class">
          <option value="">Select Class</option>
          <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="class" class="form-text text-muted text-danger"><?php echo e($errors->first('class')); ?></small>
      </div>
      <div class="form-group">
        <label for="sub_class">Sub Class </label>
        <select name="sub_class" class="form-control" id="sub_class" aria-describedby="sub_class">
          <option value="">Select Subclass</option>
        </select>
        <small id="sub_class" class="form-text text-muted text-danger"><?php echo e($errors->first('sub_class')); ?></small>
      </div>
    </div>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('item/itemlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
$('#class').on('change',function(){
  var class_id = $(this).val();
  var token = $('input[name="_token"]').val();
  $.ajax({
    url:"<?php echo e(url('subclass/getsubclass')); ?>",
    method:"post",
    dataType:'json',
    data:{id:class_id,_token:token},
    success:function(res){
      var template = '<option value="">Select Subclass</option>';
      for(var i = 0; i < res.length; i++){
        template += '<option value="'+res[i].id+'">'+res[i].class_name+'</option>';
      }
      $('#sub_class').html(template);
    }
  })
})
  
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>