@extends("admin.template")
@section("main")
<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title"> @lang("admin_messages.email_settings") @lang("admin_messages.management") </h4>
			<ul class="breadcrumbs">
				<li class="nav-home">
					<a href="{{ route('admin.dashboard') }}">
						<i class="flaticon-home"></i>
					</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">@lang("admin_messages.email_settings")</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title"> @lang("admin_messages.email_settings") </h4>
						</div>
					</div>
					{!! Form::open(['url' => route('admin.email_settings.update'), 'class' => 'form-horizontal','id'=>'email_settings-form','method' => "PUT"]) !!}
					<div class="card-body">
						<div class="form-group row">
						<label for="driver" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.driver') <em class="text-danger"> * </em></label>
						{!! Form::text('driver', old('driver',email_settings('driver')), ['class' => 'form-control input-square', 'id' => 'driver']) !!}
						<span class="text-danger">{{ $errors->first('driver') }}</span>
					</div>
					<div class="form-group row">
						<label for="host" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.host') <em class="text-danger"> * </em></label>
						{!! Form::text('host', old('host',email_settings('host')), ['class' => 'form-control input-square', 'id' => 'host']) !!}
						<span class="text-danger">{{ $errors->first('host') }}</span>
					</div>
					<div class="form-group row">
						<label for="port" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.port') <em class="text-danger"> * </em></label>
						{!! Form::text('port', old('port',email_settings('port')), ['class' => 'form-control input-square', 'id' => 'port']) !!}
						<span class="text-danger">{{ $errors->first('port') }}</span>
					</div>
					<div class="form-group row">
						<label for="encryption" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.encryption') <em class="text-danger"> * </em></label>
						{!! Form::text('encryption', old('encryption',email_settings('encryption')), ['class' => 'form-control input-square', 'id' => 'encryption']) !!}
						<span class="text-danger">{{ $errors->first('encryption') }}</span>
					</div>
					<div class="form-group row">
						<label for="from_name" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.from_name') <em class="text-danger"> * </em></label>
						{!! Form::text('from_name', old('from_name',email_settings('from_name')), ['class' => 'form-control input-square', 'id' => 'from_name']) !!}
						<span class="text-danger">{{ $errors->first('from_name') }}</span>
					</div>
					<div class="form-group row">
						<label for="from_address" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.from_address') <em class="text-danger"> * </em></label>
						{!! Form::text('from_address', old('from_address',email_settings('from_address')), ['class' => 'form-control input-square', 'id' => 'from_address']) !!}
						<span class="text-danger">{{ $errors->first('from_address') }}</span>
					</div>
					<div class="form-group row">
						<label for="username" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.username') <em class="text-danger"> * </em></label>
						{!! Form::text('username', old('username',email_settings('username')), ['class' => 'form-control input-square', 'id' => 'username']) !!}
						<span class="text-danger">{{ $errors->first('username') }}</span>
					</div>
					<div class="form-group row">
						<label for="app_password" class="col-sm-2 col-form-label"> @lang('admin_messages.email_setting.password') <em class="text-danger"> * </em></label>
						{!! Form::text('app_password', old('app_password',email_settings('password')), ['class' => 'form-control input-square', 'id' => 'app_password']) !!}
						<span class="text-danger">{{ $errors->first('app_password') }}</span>
					</div>
					</div>
					<div class="card-action">
						<button type="submit" class="btn btn-success float-right"> @lang('admin_messages.submit') </button>
						<a class="btn btn-danger" href="{{ $base_url }}"> @lang('admin_messages.cancel') </a>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection