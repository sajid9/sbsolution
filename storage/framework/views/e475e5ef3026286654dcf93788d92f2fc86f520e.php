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
  <div class="checkbox">
    <label>
      <input type="checkbox" checked="checked" id="type" data-toggle="toggle" name="type" value="tile" data-on="Tile" data-off="Item">
    </label>
  </div>
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
      <div id="tile_attr">
        
      </div>
      <div class="form-group">
        <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
        <input type="number" name="purchase_price" value="<?php echo e(old('purchase_price')); ?>" class="form-control" id="purchase_price" placeholder="Purchase Price" aria-describedby="purchase_price">
        <small id="purchase_price" class="form-text text-muted text-danger"><?php echo e($errors->first('purchase_price')); ?></small>
      </div>
      <div class="form-group">
        <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
        <input type="number" name="sale_price" value="<?php echo e(old('sale_price')); ?>" class="form-control" id="sale_price" placeholder="Sale Price" aria-describedby="sale_price">
        <small id="sale_price" class="form-text text-muted text-danger"><?php echo e($errors->first('sale_price')); ?></small>
      </div>
      <div class="form-group">
        <label for="cal_open">Opening Item <span class="text-danger">*</span></label>
        <input type="number" name="cal_open" value="<?php echo e(old('cal_open')); ?>" class="form-control" id="cal_open" placeholder="Opening Item" aria-describedby="cal_open_msg">
        <small id="cal_open_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('cal_open')); ?></small>
      </div>
      <div class="form-group">
        <label for="total_meter">Total Meter <span class="text-danger">*</span></label>
        <input type="number" name="opening" value="<?php echo e(old('opening')); ?>" class="form-control" id="opening" placeholder="Opening Item" aria-describedby="total_meter_msg">
        <small id="total_meter_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('opening')); ?></small>
      </div>
      <div class="form-group">
        <label for="discription">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description')); ?></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="group">group </label>
        <select name="group" class="form-control" id="group" aria-describedby="group_msg">
          <option value="">Select group</option>
          <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="group_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('group')); ?></small>
      </div>
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

<template id="tile_temp">
  <div class="form-group">
    <label for="color">Color <span class="text-danger">*</span></label>
    <input type="text" name="color_name" value="<?php echo e(old('color_name')); ?>" class="form-control" id="color" aria-describedby="color" placeholder="Color">
    <small id="color" class="form-text text-muted text-danger"><?php echo e($errors->first('color_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="quality">quality <span class="text-danger">*</span></label>
    <select name="quality" class="form-control" id="quality" aria-describedby="quality_msg">
      <option>Select Qualitiy</option>
      <option>Ceramic</option>
      <option>TB</option>
      <option>Tiles</option>
    </select>
    <small id="quality_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quality')); ?></small>
  </div>
  <div class="form-group">
    <label for="size">Size <span class="text-danger">*</span></label>
    <select  name="size" class="form-control" id="size" aria-describedby="size_msg" >
      <option value="">Select Size</option>
      <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option><?php echo e($size->size); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="size_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('size')); ?></small>
  </div>
  <div class="form-group">
    <label for="meter_per_box">Meter Per Box <span class="text-danger">*</span></label>
    <input type="text" name="meter_per_box" value="<?php echo e(old('meter_per_box')); ?>" class="form-control" id="meter_per_box" aria-describedby="meter_per_box_msg" placeholder="Meter Per Box">
    <small id="meter_per_box_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('meter_per_box')); ?></small>
  </div>
  <div class="form-group">
    <label for="piece_in_box">Pieces Per Box <span class="text-danger">*</span></label>
    <input type="text" name="piece_in_box" value="<?php echo e(old('piece_in_box')); ?>" class="form-control" id="piece_in_box" aria-describedby="piece_in_box_msg" placeholder="Pieces Per Box">
    <small id="piece_in_box_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('piece_in_box')); ?></small>
  </div>
</template>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
$(document).ready(function(){
  $('#tile_attr').html($('#tile_temp').html());

  $('#cal_open').on('blur',function(){
    if($('#type').parent().hasClass('off')){
      $('#opening').val($(this).val());
    }else{
      $('#opening').val(parseInt($(this).val()) * parseFloat($('#meter_per_box').val()));
    }
  }) 
  $('#meter_per_box').on('blur',function(){
    if($('#type').parent().hasClass('off')){
      $('#opening').val($('#cal_open').val());
    }else{
      $('#opening').val(parseInt($('#cal_open').val()) * parseFloat($(this).val()));
    }
  })
})

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
$('#type').on('change',function(){
  if($(this).parent().hasClass('off')){
    $('#tile_attr').html('');
  }else{
    $('#tile_attr').html($('#tile_temp').html());
  }
})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>