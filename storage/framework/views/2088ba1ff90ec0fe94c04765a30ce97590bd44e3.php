<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'User And Role Mangement'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">

<div class="panel-body">
<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <ul class="nav nav-pills"  id="myTab">
    <li class="active"><a data-toggle="pill" href="#home">Users</a></li>
    <li><a data-toggle="pill" href="#menu1">Roles</a></li>
  </ul>
  <div class="tab-content">


    <div id="home" class="tab-pane fade in active">
     <div class="col-md-12">
		<button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-target="#userModal">  <i class="fa fa-plus"></i> Add user
		</button>
		  <!-- Modal -->
   <div class="modal fade" id="userModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Register New User</h4>
        </div>
        <div class="modal-body">
         
        <form method="POST" action="<?php echo e(route('insert_user')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="form-text text-muted text-danger"><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                               <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" id="email" required/>

                                <?php if($errors->has('email')): ?> 
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="form-text text-muted text-danger"><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong  class="form-text text-muted text-danger"><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                       
                         <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Select Role</label>

                            <div class="col-md-6">
                            	<select name="role" class="form-control" id="role" aria-describedby="group_msg" required>
            <option value="">Select Role</option>
          <?php $__currentLoopData = $allroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($role->id); ?>"><?php echo e($role->role); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
            
                            </div>


                                <?php if($errors->has('role')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="form-text text-muted text-danger"><?php echo e($errors->first('role')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>

         
                </div>
              <div class="modal-footer">
        	 <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register')); ?>

                                </button>  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
                 </form>


    </div>
    
  </div>
   <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
              <thead>
                  <tr>
                      <th>Sr #</th>
                      <th>Name</th>
                      <th>email</th>
                       <th>Role</th>
                        <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr class="odd gradeX">
                      <td><?php echo e($user->id); ?></td>
                      <td><?php echo e($user->name); ?></td>
                      <td><?php echo e($user->email); ?></td>
                      <td><?php echo e((isset($user->Role)) ? $user->Role->role : ''); ?></td>
                      <td></td>
                      
                  </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table>
	</div>
    </div>






    <div id="menu1" class="tab-pane fade">
      <div class="col-md-12">
		<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#roleModal">  <i class="fa fa-plus"></i> Add Role
		</button>
		  <!-- Modal -->
      <div class="modal fade" id="roleModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create New Role</h4>
        </div>
        <div class="modal-body">
          
     <form method="post" action="<?php echo e(route('insert_user_role')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
     <div class="form-group">
    <label for="role">Role Name <span class="text-danger">*</span></label>
    <input type="text" name="role_name"  class="form-control" id="role_name" aria-describedby="role" placeholder="Role Name"required>
    <small id="name" class="form-text text-muted text-danger"><?php echo e($errors->first('role_name')); ?></small>
  </div>
  <div class="form-group">
        <label for="status"> Status</label>
        <select name="status" class="form-control" id="status" aria-describedby="status" required>
          <option value="">Select Status</option>
        
            <option value="1">Active</option>
              <option value="0">Deactive</option>
        
        
        </select>
        <small id="unit_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('status')); ?></small>
      </div>

        </div>
             <div class="modal-footer">
        	  <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           </form>
      
        </div>
      </div>
 
    </div>
  </div>
	</div>


   <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
              <thead>
                  <tr>
                      <th>Sr #</th>
                      <th>Role Name</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $__currentLoopData = $allroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr class="odd gradeX">
                      <td><?php echo e($role->id); ?></td>
                      <td><?php echo e($role->role); ?></td>
                    <?php if($role->status ==1): ?>         
                     <td><button class="btn btn-success btn-sm">Active</button></td>         
                    <?php else: ?>
                   <td><button class="btn btn-danger btn-sm">Deactive</button></td>        
                     <?php endif; ?>
                      <td>
                          <a href="<?php echo e(route('edit_role',['id'=> $role->id])); ?>" class="btn btn-info btn-sm"> Edit</a>
                        <a href="<?php echo e(route('delete_role',['id'=> $role->id])); ?>" class="btn btn-danger btn-sm"> Delete</a>
                      </td>
                      
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table>
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
  <script>
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

$('#myTab a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav.nav-pills > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#myTab a[href="' + hash + '"]').tab('show');


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\sb_solution\resources\views/pages/user_mangement/dashboard.blade.php ENDPATH**/ ?>