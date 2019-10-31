<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Edit item'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Item
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('item/updateitem')); ?>">
  <?php echo csrf_field(); ?>
  <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
  <input type="hidden" name="type" value="<?php echo e($item->type); ?>">
  
  
  <?php if($item->type == 'item'): ?>
    <?php echo $__env->make('pages.items.edit_item_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  
  
  
  <?php if($item->type == 'service'): ?>
    <?php echo $__env->make('pages.items.edit_service_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  
  
  
  <?php if($item->type == 'tile'): ?>
    <?php echo $__env->make('pages.items.edit_tile_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes' || $item->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
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
$(document).on('change','#class',function(){
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
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/items/edit_item_form.blade.php ENDPATH**/ ?>