  
  
  
  
  

  
  <?php $__env->startSection('title', 'Dashboard'); ?>
  <?php $__env->startSection('pagetitle', 'User And Role Management'); ?>



  <?php $__env->startSection('content'); ?>

    <?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <ul class="nav nav-pills"  id="myTab">
      <li class="active"><a data-toggle="pill" href="#users">Users</a></li>
      <li><a data-toggle="pill" href="#role">Roles</a></li>
    </ul>
    
    <div class="tab-content">
      
      <div id="users" class="tab-pane fade in active">
        <?php echo $__env->make('pages.user_mangement.user_mangement_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
      <div id="role" class="tab-pane fade">
       
        <?php echo $__env->make('pages.user_mangement.role_mangement_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
    </div>
    

  <?php $__env->stopSection(); ?>




  <?php $__env->startSection('footer'); ?>
  ##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##

  <!-- DataTables JavaScript -->
  <script src="<?php echo e(asset('js/dataTables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>

  <script>
     
    $(document).ready(function() {
      $('#edituser').on('click',function(){
        var val = $(this).closest('tr').find('td').eq(3).text();
        console.log(val);
      })


     });

    $(document).ready(function() {
      $('#dataTables-example1').DataTable({
        responsive: true
      });
      $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function() {
      $('#dataTables-example2').DataTable({
        responsive: true
      });
      $('[data-toggle="tooltip"]').tooltip();



    });
  


  </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\sb_solution\resources\views/pages/user_mangement/dashboard.blade.php ENDPATH**/ ?>