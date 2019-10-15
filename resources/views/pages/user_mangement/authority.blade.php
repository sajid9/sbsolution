<form style="padding-top:20px" method="post" action="{{ url('user_mangement/addauthority') }}">
	<div class="form-group">
	  @csrf
	  <label for="role-auth">Select Role <span class="text-danger">*</span></label>
	  <select name="role" class="form-control" id="role-auth" aria-describedby="role_msg">
	  	<option value="">Select role</option>
	  	@foreach($allroles as $role)
	  		<option value="{{$role->id}}">{{$role->role}}</option>
	  	@endforeach
	  </select>
	  <small id="role_msg" class="form-text text-muted text-danger">{{$errors->first('role')}}</small>
	</div>
	<div id="html"></div>
	<button type="button" id="addauthority" class="btn btn-primary">Submit</button>
</form>

