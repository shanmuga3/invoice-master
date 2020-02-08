@extends("admin.template")
@section("main")
<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title"> @lang("admin_messages.admin_users") @lang("admin_messages.management") </h4>
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
					<a href="{{ route('admin.admin_users') }}">@lang("admin_messages.admin_users")</a>
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
							<h4 class="card-title"> @lang("admin_messages.admin_users") </h4>
							
						</div>
					</div>
					{!! Form::open(['url' => route('admin.admin_users.update',['id' => $result->id]), 'class' => 'form-horizontal','id'=>'user_form','method' => "PUT"]) !!}
					@include('admin.admin_users.form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection