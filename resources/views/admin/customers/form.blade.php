<div class="card-body">
	<div class="form-group row">
		<label for="first_name" class="col-sm-2 col-form-label"> @lang('admin_messages.users.first_name') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('first_name', @$result->first_name, ['class' => 'form-control input-square', 'id' => 'first_name']) !!}
			<span class="text-danger">{{ $errors->first('first_name') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="last_name" class="col-sm-2 col-form-label"> @lang('admin_messages.users.last_name') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('last_name', @$result->last_name, ['class' => 'form-control input-square', 'id' => 'last_name']) !!}
			<span class="text-danger">{{ $errors->first('last_name') }}</span>
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
		<label for="mobile_number" class="col-sm-2 col-form-label"> @lang('admin_messages.users.mobile_number') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('mobile_number', @$result->mobile_number, ['class' => 'form-control input-square', 'id' => 'mobile_number']) !!}
			<span class="text-danger">{{ $errors->first('mobile_number') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="address_line_1" class="col-sm-2 col-form-label"> @lang('admin_messages.users.address_line_1') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('address_line_1', @$result->address_line_1, ['class' => 'form-control input-square', 'id' => 'address_line_1']) !!}
			<span class="text-danger">{{ $errors->first('address_line_1') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="address_line_2" class="col-sm-2 col-form-label"> @lang('admin_messages.users.address_line_2') </label>
		<div class="col-sm-10">
			{!! Form::text('address_line_2', @$result->address_line_2, ['class' => 'form-control input-square', 'id' => 'address_line_2']) !!}
			<span class="text-danger">{{ $errors->first('address_line_2') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="city" class="col-sm-2 col-form-label"> @lang('admin_messages.users.city') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('city', @$result->city, ['class' => 'form-control input-square', 'id' => 'city']) !!}
			<span class="text-danger">{{ $errors->first('city') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="state" class="col-sm-2 col-form-label"> @lang('admin_messages.users.state') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('state', @$result->state, ['class' => 'form-control input-square', 'id' => 'state']) !!}
			<span class="text-danger">{{ $errors->first('state') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="postal_code" class="col-sm-2 col-form-label"> @lang('admin_messages.users.postal_code') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('postal_code', @$result->postal_code, ['class' => 'form-control input-square', 'id' => 'postal_code']) !!}
			<span class="text-danger">{{ $errors->first('postal_code') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="country_code" class="col-sm-2 col-form-label"> @lang('admin_messages.users.country_code') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('country_code', @$result->country_code, ['class' => 'form-control input-square', 'id' => 'country_code']) !!}
			<span class="text-danger">{{ $errors->first('country_code') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="status" class="col-sm-2 col-form-label"> @lang('admin_messages.status') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::select('status', array('Active' => 'Active', 'Inactive' => 'Inactive'), @$result->status, ['class' => 'form-control', 'id' => 'status', 'placeholder' => Lang::get("admin_messages.status")]) !!}
			<span class="text-danger">{{ $errors->first('status') }}</span>
		</div>
	</div>
</div>
<div class="card-action">
	<button type="submit" class="btn btn-success float-right"> @lang('admin_messages.submit') </button>
	<a class="btn btn-danger" href="{{ $base_url }}"> @lang('admin_messages.cancel') </a>
</div>