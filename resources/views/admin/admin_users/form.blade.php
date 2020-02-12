<div class="card-body">
	<div class="form-group row">
		<label for="username" class="col-sm-2 col-form-label"> @lang('admin_messages.users.user_name') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('username', @$result->username, ['class' => 'form-control input-square', 'id' => 'username']) !!}
			<span class="text-danger">{{ $errors->first('username') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="email" class="col-sm-2 col-form-label"> @lang('admin_messages.users.email_address') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::email('email', @$result->email, ['class' => 'form-control input-square', 'id' => 'email']) !!}
			<span class="text-danger">{{ $errors->first('email') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="password" class="col-sm-2 col-form-label"> @lang('admin_messages.users.password') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('password', '', ['class' => 'form-control input-square', 'id' => 'password' ]) !!}
			<span class="text-danger">{{ $errors->first('password') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="role" class="col-sm-2 col-form-label"> @lang('admin_messages.users.role') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::select('role', $roles, @$role_id, ['class' => 'form-control', 'id' => 'role', 'placeholder' => 'Role']) !!}
			<span class="text-danger">{{ $errors->first('role') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="status" class="col-sm-2 col-form-label"> @lang('admin_messages.status') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), @$result->status, ['class' => 'form-control py-0', 'id' => 'status', 'placeholder' => Lang::get("admin_messages.status")]) !!}
			<span class="text-danger">{{ $errors->first('status') }}</span>
		</div>
	</div>
</div>
<div class="card-action">
	<button type="submit" class="btn btn-success float-right"> @lang('admin_messages.submit') </button>
	<a class="btn btn-danger" href="{{ route('admin.admin_users') }}"> @lang('admin_messages.cancel') </a>
</div>