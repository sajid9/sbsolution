  
  
  
  
  

  
  <?php $__env->startSection('title', 'Dashboard'); ?>
  <?php $__env->startSection('pagetitle', 'User And Role Management'); ?>
  <?php $__env->startSection('header'); ?>
  ##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dist/themes/default/style.css')); ?>">
  <?php $__env->stopSection(); ?>


  <?php $__env->startSection('content'); ?>

    <?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <ul class="nav nav-pills"  id="myTab">
      <li class="active"><a data-toggle="pill" href="#users">Users</a></li>
      <li><a data-toggle="pill" href="#role">Roles</a></li>
      <li><a data-toggle="pill" href="#authority">Authority</a></li>
    </ul>
    
    <div class="tab-content">
      
      <div id="users" class="tab-pane fade in active">
        <?php echo $__env->make('pages.user_mangement.user_mangement_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
      <div id="role" class="tab-pane fade">
       
        <?php echo $__env->make('pages.user_mangement.role_mangement_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div id="authority" class="tab-pane fade">
        <?php echo $__env->make('pages.user_mangement.authority', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      
    </div>
  
    
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##

<!-- DataTables JavaScript -->
<script src="<?php echo e(asset('js/dataTables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('dist/jstree.min.js')); ?>"></script>
<script>
  
    $('#html').jstree({
      'core' : {
        'data' : {
                "url" : "<?php echo e(url('user_mangement/getauthority')); ?>",
                "dataType" : "json" // needed only if you do not supply JSON headers
              }
            },
      "types" : {
          "default" : {
            "icon" : "glyphicon glyphicon-user"
          },
          "demo" : {
            "icon" : "glyphicon glyphicon-user"
          }
        },
        
      'plugins':["checkbox","types"]
    });
    /*check if role exsist load it in tree*/
    $('#role-auth').on('change',function(){
      var role = $(this).val();
      $.ajax({
        url:"<?php echo e(route('checkrole')); ?>",
        type:"post",
        dataType:"json",
        data:{role:role,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          if(res.length > 0){
            $('#auth_id').val(res[0].id);
            $('#html').jstree(true).uncheck_all();
            $('#html').jstree(true).close_all();
            $('#html').jstree('select_node', res[0].selected_ids);
          }else{
            $('#auth_id').val('');
            $('#html').jstree(true).uncheck_all();
            $('#html').jstree(true).close_all();
          }
        }
      });
    })
    /*add authority to the database get from the js tree*/
    $('#addauthority').on('click',function(){
      var role = $('#role-auth').val();
      var parent_id = $('#auth_id').val();
      var selectedData = [];
      var selectedID = [];
      var selectedIndexes;
        selectedIndexes = $("#html").jstree("get_selected", true);
        jQuery.each(selectedIndexes, function (index, value) {
          selectedData.push(selectedIndexes[index].text);
          selectedID.push(selectedIndexes[index].id);
        });
      $.ajax({
        url:"<?php echo e(url('user_mangement/addauthority')); ?>",
        type:"post",
        dataType:"json",
        data:{parent_id:parent_id,role:role,roles:selectedData,id:selectedID,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          if(res.message){
            $.toast({
              heading: 'SUCCESS',
              text: res.message,
              icon: 'success',
              position: 'top-right', 
              loader: true,        // Change it to false to loader
              loaderBg: '#9EC600'  // To change the background
            })
          }
        }
      });
    })
    /*end js tree code*/
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
// standard on load code goes here with $ prefix
// note: the $ is setup inside the anonymous function of the ready command

    $(document).ready(function() {
      $('#edituser').on('click',function(){
        var val = $(this).closest('tr').find('td').eq(3).text();
        console.log(val);
      })
     });


  </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sbsolution\resources\views/pages/user_mangement/dashboard.blade.php ENDPATH**/ ?>