   <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#roleModal" style="margin-top: 3px">  <i class="fa fa-plus"></i> Add Role
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
            <input type="text" name="role_name"  class="form-control" aria-describedby="role" placeholder="Role Name"required>
            <small id="name" class="form-text text-muted text-danger"><?php echo e($errors->first('role_name')); ?></small>
          </div>
          <div class="form-group">
            <label for="status"> Status</label>
            <select name="status" class="form-control" aria-describedby="status" required>
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
<!--ends  Modal -->
<div class="panel panel-success" style="margin-top: 15px">
  <div class="panel-heading">Roles</div>
  <div class="panel-body">
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
          <td><label class="label label-primary">Active</label></td>         
          <?php else: ?>
          <td><label class="label label-danger">Deactive</label></td>        
          <?php endif; ?>
          <td>
            <a class="btn btn-xs btn-warning" type="button" class="" data-toggle="modal" data-target="#edit<?php echo e($role->id); ?>">  <i class="fa fa-edit"></i>
            </a>
            <a class="btn btn-xs btn-danger" href="<?php echo e(route('delete_role',['id'=> $role->id])); ?>" class=""> <i class="fa fa-trash"></i> </a>
          </td>
        </tr>
        
        <div class="modal fade" id="edit<?php echo e($role->id); ?>" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Role</h4>
              </div>
              <div class="modal-body">
               <form method="post" action="<?php echo e(route('edit_role',['id'=> $role->id])); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for="role">Role Name <span class="text-danger">*</span></label>
                  <input type="text" name="role_name"  class="form-control"  aria-describedby="role" placeholder="Role Name" value="<?php echo e($role->role); ?>" required>
                  <small  class="form-text text-muted text-danger"><?php echo e($errors->first('role_name')); ?></small>
                </div>
                <div class="form-group">
                  <label for="status"> Status</label>
                  <select name="status" class="form-control"  aria-describedby="status" required>
                    <?php if($role->status==1): ?>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    <?php else: ?>
                    <option value="0">Deactive</option>
                    <option value="1">Active</option>
                    <?php endif; ?>
                  </select>
                  <small id="unit_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('status')); ?></small>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--ends  Modal -->
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
  </div>
</div>
<?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/user_mangement/role_mangement_tab.blade.php ENDPATH**/ ?>