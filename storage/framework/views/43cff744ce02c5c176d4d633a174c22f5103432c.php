<template id="item_template">
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="barcode">Barcode <span class="text-danger">*</span></label>
      <input type="text" name="barcode" value="<?php echo e(old('barcode')); ?>" class="form-control" id="barcode" placeholder="Short Code" aria-describedby="barcode">
      <small id="barcode" class="form-text text-muted text-danger"><?php echo e($errors->first('barcode')); ?></small>
    </div>
    <div class="form-group">
      <label for="itemname">Item Name <span class="text-danger">*</span></label>
      <input type="text" name="item_name" value="<?php echo e(old('item_name')); ?>" class="form-control" id="itemname" aria-describedby="itemname" placeholder="item Name">
      <small id="itemname" class="form-text text-muted text-danger"><?php echo e($errors->first('item_name')); ?></small>
    </div>
    <div class="form-group">
      <label for="color">Color</label>
      <input type="text" name="color_name" value="<?php echo e(old('color_name')); ?>" class="form-control" id="color" aria-describedby="color" placeholder="Color">
      <small id="color" class="form-text text-muted text-danger"><?php echo e($errors->first('color_name')); ?></small>
    </div>
    
    <div class="form-group">
      <label for="low_stock">Low Stock</label>
      <input type="number" name="low_stock" value="<?php echo e(old('low_stock')); ?>" class="form-control" id="low_stock" aria-describedby="low_stock_msg" placeholder="Low Stock">
      <small id="low_stock_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('low_stock')); ?></small>
    </div>
  </div>
  <div class="col-md-4">
    
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
      <label for="company">Company </label>
      <select name="company" class="form-control" id="company" aria-describedby="company">
        <option value="">Select Company</option>
        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <small id="company" class="form-text text-muted text-danger"><?php echo e($errors->first('company')); ?></small>
    </div>
  </div>
  <div class="col-md-4">
    
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
    <div class="form-group">
      <label for="discription">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description')); ?></textarea>
    </div>
  </div>
</div>
</template><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/items/item_template.blade.php ENDPATH**/ ?>