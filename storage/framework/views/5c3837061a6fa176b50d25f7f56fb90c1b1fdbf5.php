<template id="service_template">
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="barcode">Barcode <span class="text-danger">*</span></label>
      <input type="text" name="barcode" value="<?php echo e(old('barcode')); ?>" class="form-control" id="barcode" placeholder="Short Code" aria-describedby="barcode">
      <small id="barcode" class="form-text text-muted text-danger"><?php echo e($errors->first('barcode')); ?></small>
    </div>
    <div class="form-group">
      <label for="itemname">Name <span class="text-danger">*</span></label>
      <input type="text" name="item_name" value="<?php echo e(old('item_name')); ?>" class="form-control" id="itemname" aria-describedby="itemname" placeholder="item Name">
      <small id="itemname" class="form-text text-muted text-danger"><?php echo e($errors->first('item_name')); ?></small>
    </div>
    <div class="form-group">
      <label for="sale_price">Service Price <span class="text-danger">*</span></label>
      <input type="hidden" name="purchase_price" id="purchase_price">
      <input type="number" name="sale_price" value="<?php echo e(old('sale_price')); ?>" class="form-control" id="sale_price" placeholder="Sale Price" aria-describedby="sale_price">
      <small id="sale_price" class="form-text text-muted text-danger"><?php echo e($errors->first('sale_price')); ?></small>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="duration">Duration <span class="text-danger">*</span></label>
      <input type="text" name="duration" value="<?php echo e(old('duration')); ?>" class="form-control" id="duration" placeholder="Sale Price" aria-describedby="duration_msg">
      <small id="duration_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('duration')); ?></small>
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
    
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="sub_class">Sub Class </label>
      <select name="sub_class" class="form-control" id="sub_class" aria-describedby="sub_class">
        <option value="">Select Subclass</option>
      </select>
      <small id="sub_class" class="form-text text-muted text-danger"><?php echo e($errors->first('sub_class')); ?></small>
    </div>    
    <div class="form-group">
      <label for="discription">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description')); ?></textarea>
    </div>
  </div>
</div>
</template><?php /**PATH E:\xamp\htdocs\sb_solution\resources\views/pages/items/service_template.blade.php ENDPATH**/ ?>