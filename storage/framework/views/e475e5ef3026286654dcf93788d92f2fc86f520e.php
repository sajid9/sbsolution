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
  <p class="radio">
    <?php if(env("ITEM_MODULE") == 'yes'): ?>
    Item:
    <input class="type flat" type="radio" value="item" name="type" checked/>
    <?php endif; ?>
    <?php if(env("SERVICE_MODULE") == 'yes'): ?>
    Service:
    <input class="type flat" type="radio" value="service" name="type"/>
    <?php endif; ?>
    <?php if(env("TILE_MODULE") == 'yes'): ?>
    Tile:
    <input class="type flat" type="radio" value="tile" name="type"/>
    <?php endif; ?>
  </p>
  
  <hr>
  <div id="template_append">
    
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('item/itemlisting')); ?>" class="btn btn-default">Back</a>
</form>


  <?php echo $__env->make('pages.items.tile_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <?php echo $__env->make('pages.items.item_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <?php echo $__env->make('pages.items.service_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
$(document).ready(function(){
  $('#template_append').html($('#item_template').html());
  $('#cal_open').on('blur',function(){
    $('#opening').val($(this).val());
  })
  
  /*$('#meter_per_box').on('blur',function(){
    if($('#type').parent().hasClass('off')){
      $('#opening').val($('#cal_open').val());
    }else{
      $('#opening').val(parseInt($('#cal_open').val()) * parseFloat($(this).val()));
    }
  })*/
  $(document).on('keyup','#barcode',function(){
    var barcoad = $(this).val();
    $('#itemname').val(barcoad);
  })
  $(document).on('keyup','#sale_price',function(){
    if($('.type:checked').val() == 'service'){
      var price = $(this).val();
      $('#purchase_price').val(price);
    }
  })
})

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
$('.type').on('ifChecked',function(){
  if($(this).val() == 'item'){
    $('#template_append').html($('#item_template').html());
    
  }else if($(this).val() == 'tile'){
    $('#template_append').html($('#tile_template').html());
  }else{
    $('#template_append').html($('#service_template').html());
  }
})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/items/add_item_form.blade.php ENDPATH**/ ?>