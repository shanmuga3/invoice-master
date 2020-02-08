@extends("admin.template")
@section("main")
<div class="content">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title"> @lang("admin_messages.invoice_templates") @lang("admin_messages.management") </h4>
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
					<a href="#">@lang("admin_messages.invoice_templates")</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title"> @lang("admin_messages.invoice_templates") </h4>
							@checkPermission('create-invoice_templates')
							<a class="btn btn-primary btn-round ml-auto" href="{{ route('admin.invoice_templates.create') }}">
								<i class="fa fa-plus"></i>
								@lang("admin_messages.add_invoice_template")
							</a>
							@endcheckPermission
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							{!! $dataTable->table() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
	<script type="text/javascript" src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
	{!! $dataTable->scripts() !!}
@endpush