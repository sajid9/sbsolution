  
  
  
  
  

  
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
        'data' : [
          { "text" : "Items Info", "children" : [
              { "text" : "Add Item" },
              { "text" : "Opening item" },
              { "text" : "Item Ledger" },
              { "text" : "Stock Report" },
              { "text" : "Stores" },
              { "text" : "Groups" },
              { "text" : "Measuring Unit" },
              { "text" : "Sizes" },
              { "text" : "Companies" },
              { "text" : "Categories" },
              { "text" : "Classes" },
          ]},
          { "text" : "Voucher Info", "children" : [
              { "text" : "Voucher" },
              { "text" : "Voucher Ledger" },
              { "text" : "Voucher Payable" },
              { "text" : "Direct In" },
              { "text" : "Add Suppliers" },
              { "text" : "Opening Suppliers" },
              { "text" : "Supplier Ledger" },
              { "text" : "Supplier Payable" },
          ]},
          { "text" : "Sale Info", "children" : [
              { "text" : "Add Receipt" },
              { "text" : "Receipt Ledger" },
              { "text" : "Receipt Receivable" },
              { "text" : "Direct Out" },
              { "text" : "Add Customers" },
              { "text" : "Opening Customers" },
              { "text" : "Customer Ledger" },
              { "text" : "Customer Receivable" },
          ]},
          { "text" : "Payment Info", "children" : [
              { "text" : "Payments" },
          ]},
          { "text" : "Account Info", "children" : [
              { "text" : "Accounts" },
              { "text" : "Cash Deposit" },
              { "text" : "Accounts Ledger" },
              { "text" : "Financial Year" },
          ]},
          { "text" : "Expenditure", "children" : [
              { "text" : "Heads" },
              { "text" : "Months" },
          ]},
          {"text":"User management"}
        ]
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
    /*on change get js tree value*/
    $('#html').on("changed.jstree", function (e, data) {
          var selectedData = [];
          var selectedIndexes;
           selectedIndexes = $("#html").jstree("get_selected", true);
           jQuery.each(selectedIndexes, function (index, value) {
                   selectedData.push(selectedIndexes[index].id);
           });
           console.log(selectedData);
      });
    $('#addauthority').on('click',function(){
      var role = $('#role-auth').val();
      var selectedData = [];
      var selectedIndexes;
        selectedIndexes = $("#html").jstree("get_selected", true);
        jQuery.each(selectedIndexes, function (index, value) {
          selectedData.push(selectedIndexes[index].text);
        });
      $.ajax({
        url:"<?php echo e(url('user_mangement/addauthority')); ?>",
        type:"post",
        dataType:"json",
        data:{role:role,roles:selectedData,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          if(res.message == 'datasave'){
            $.toast({
              heading: 'SUCCESS',
              text: 'Authority Successfull',
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

<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>