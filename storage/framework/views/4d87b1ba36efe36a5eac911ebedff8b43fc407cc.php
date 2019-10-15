
<button type="button" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#userModal">  <i class="fa fa-plus"></i> Add User
</button>
<!-- insert user Modal -->
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
							<input  type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

							<?php if($errors->has('name')): ?>
							<span class="invalid-feedback" role="alert">
								<strong class="form-text text-muted text-danger"><?php echo e($errors->first('name')); ?></strong>
							</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group row">
						<label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"  required/>

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
							<input  type="password" class="form-control" name="password" required>

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
							<select name="role" class="form-control"  aria-describedby="group_msg" required>
								<option value="">Select Role</option>
								<?php $__currentLoopData = $allroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($role->id); ?>"><?php echo e($role->role); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">
							Save
						</button>  
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
				
			</div>
		</div>
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
			<td>
				<a type="button" class="" data-toggle="modal" data-target="#edit<?php echo e($user->id); ?>">  <i class="fa fa-edit"></i> 
				</a>
				<a href="<?php echo e(route('delete_user',['id'=> $user->id])); ?>" class=""> <i class="fa fa-trash"></i> </a>
			</td>
		</tr>
		<!-- user Edit Modal -->
		<div class="modal fade" id="edit<?php echo e($user->id); ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Update User</h4>
					</div>
					<div class="modal-body">
						<form method="POST" action="<?php echo e(route('edit_user',['id'=> $user->id])); ?>">
							<?php echo csrf_field(); ?>
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

								<div class="col-md-6">
									<input  type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" required autofocus>

									<?php if($errors->has('name')): ?>
									<span class="invalid-feedback" role="alert">
										<strong class="form-text text-muted text-danger"><?php echo e($errors->first('name')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>"  required/>
									<?php if($errors->has('email')): ?> 
									<span class="invalid-feedback" role="alert">
										<strong class="form-text text-muted text-danger"><?php echo e($errors->first('email')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>
						
							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Select Role</label>

								<div class="col-md-6">
									<select name="role" class="form-control user_assgine_role"  aria-describedby="group_msg" required>
										<option value="">Select Role</option>
										<?php $__currentLoopData = $allroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($role->id); ?>" <?php echo e(($user->role_id == $role->id) ? 'selected' : ''); ?>><?php echo e($role->role); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
								<?php if($errors->has('role')): ?>
								<span class="invalid-feedback" role="alert">
							<strong class="form-text text-muted text-danger"><?php echo e($errors->first('role')); ?></strong>
								</span>
								<?php endif; ?>
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
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>

<?php /**PATH E:\xamp\htdocs\sb_solution\resources\views/pages/user_mangement/user_mangement_tab.blade.php ENDPATH**/ ?>