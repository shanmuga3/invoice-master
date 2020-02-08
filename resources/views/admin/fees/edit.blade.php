@extends("admin.template")
@section("main")
<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title"> @lang("admin_messages.fees") @lang("admin_messages.management") </h4>
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
					<a href="{{ route('admin.fees') }}">@lang("admin_messages.fees")</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">@lang("admin_messages.edit")</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title"> @lang("admin_messages.fees") </h4>
							
						</div>
					</div>
					{!! Form::open(['url' => route('admin.fees.update',['id' => $result->id]), 'class' => 'form-horizontal','id'=>'fees-form','method' => "PUT"]) !!}
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
								{!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), @$result->status, ['class' => 'form-control', 'id' => 'status', 'placeholder' => Lang::get("admin_messages.status")]) !!}
								<span class="text-danger">{{ $errors->first('status') }}</span>
							</div>
						</div>
					</div>
					<div class="card-action">
						<button type="submit" class="btn btn-success float-right"> @lang('admin_messages.submit') </button>
						<a class="btn btn-danger" href="{{ route('admin.fees') }}"> @lang('admin_messages.cancel') </a>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection