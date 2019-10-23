<form style="padding-top:20px" method="post" action="<?php echo e(url('user_mangement/addauthority')); ?>">
	<div class="form-group">
	  <?php echo csrf_field(); ?>
	  <input type="hidden" name="parent_id" id="auth_id">
	  <label for="role-auth">Select Role <span class="text-danger">*</span></label>
	  <select name="role" class="form-control" id="role-auth" aria-describedby="role_msg">
	  	<option value="">Select role</option>
	  	<?php $__currentLoopData = $allroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  		<option value="<?php echo e($role->id); ?>"><?php echo e($role->role); ?></option>
	  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </select>
	  <small id="role_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('role')); ?></small>
	</div>
	<div id="html"></div>
	<button type="button" id="addauthority" class="btn btn-primary">Submit</button>
</form>

