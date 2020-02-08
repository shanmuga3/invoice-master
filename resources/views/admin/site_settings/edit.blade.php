@extends("admin.template")
@section("main")
<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title"> @lang("admin_messages.site_settings") @lang("admin_messages.management") </h4>
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
					<a href="#">@lang("admin_messages.site_settings")</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title"> @lang("admin_messages.site_settings") </h4>
						</div>
					</div>
					{!! Form::open(['url' => route('admin.site_settings.update'), 'class' => 'form-horizontal','id'=>'site_settings-form','method' => "PUT"]) !!}
					<div class="card-body">
						<div class="form-group row">
							<label for="site_name" class="col-sm-2 col-form-label"> @lang('admin_messages.site_setting.site_name') <em class="text-danger"> * </em></label>
							{!! Form::text('site_name', old('site_name',site_settings('site_name')), ['class' => 'form-control input-square', 'id' => 'site_name']) !!}
							<span class="text-danger">{{ $errors->first('site_name') }}</span>
						</div>
						<div class="form-group row">
							<label for="site_version" class="col-sm-2 col-form-label"> @lang('admin_messages.site_setting.site_version') <em class="text-danger"> * </em></label>
							{!! Form::text('site_version', old('site_version',site_settings('site_version')), ['class' => 'form-control input-square', 'id' => 'site_version']) !!}
							<span class="text-danger">{{ $errors->first('site_version') }}</span>
						</div>
						<div class="form-group row">
							<label for="admin_url" class="col-sm-2 col-form-label"> @lang('admin_messages.site_setting.admin_url') <em class="text-danger"> * </em></label>
							{!! Form::text('admin_url', old('admin_url',site_settings('admin_url')), ['class' => 'form-control input-square', 'id' => 'admin_url']) !!}
							<span class="text-danger">{{ $errors->first('admin_url') }}</span>
						</div>
						<div class="form-group row">
							<label for="support_number" class="col-sm-2 col-form-label"> @lang('admin_messages.site_setting.support_number') <em class="text-danger"> * </em></label>
							{!! Form::text('support_number', old('support_number',site_settings('support_number')), ['class' => 'form-control input-square', 'id' => 'support_number']) !!}
							<span class="text-danger">{{ $errors->first('support_number') }}</span>
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