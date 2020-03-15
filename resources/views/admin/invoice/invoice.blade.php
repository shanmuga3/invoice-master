@extends("admin.template")
@section("main")
<div class="content" ng-controller="invoiceController">
	<div class="page-inner">
		<div class="page-header">
			<h4 class="page-title"> @lang("admin_messages.invoice") @lang("admin_messages.management") </h4>
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
					<a href="{{ route('admin.invoice') }}">@lang("admin_messages.invoice")</a>
				</li>
				<li class="separator">
					<i class="flaticon-right-arrow"></i>
				</li>
				<li class="nav-item">
					<a href="#">@lang("admin_messages.detail")</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="row justify-content-center">
				<div class="col-10 col-lg-10">
					<div class="row align-items-center">
						<div class="col">
							<h4 class="page-title"> @lang('admin_messages.invoice') #{{ $result->invoice_number }}</h4>
						</div>
						<div class="col-auto">
							<a href="#" class="btn btn-primary btn-border ml-2" onclick="printInvoice()">
								@lang('admin_messages.print')
							</a>
							{{--
							<a href="#" class="btn btn-primary">
								@lang('admin_messages.download')
							</a>
							--}}
						</div>
					</div>
					<div class="page-divider"></div>
					<div class="row" id="invoice">
						<div class="col-md-12">
							<div class="card card-invoice">
								<div class="card-header">
									<div class="invoice-header text-center">
										<h3 class="invoice-title"> @lang("admin_messages.invoice") </h3>
									</div>
									<div class="row">
										<div class="col-md-6 info-invoice">
											<div class="float-left">
												<h5 class="sub"> @lang("admin_messages.invoice_details.invoice_to") </h5>
												<span class="font-weight-bold"> {{ $result->customer->full_name }} </span>
												<span class="d-block"> {{ $result->customer->address_line_1 }} </span>
												<span class="d-block"> {{ $result->customer->address_line_2 }} </span>
												<span class="d-block"> {{ $result->customer->city.', '.$result->customer->state }} </span>
												<span class="d-block"> {{ $result->customer->country_code.', '.$result->customer->postal_code }} </span>
												<span class="d-block"> {{ $result->customer->mobile_number }} </span>
												<span class="d-block"> {{ $result->customer->email }} </span>
											</div>
										</div>
										<div class="col-md-6 info-invoice">
											<div class="invoice-desc">
												<h5 class="sub"> @lang("admin_messages.invoice_details.invoice_from") </h5>
												<span class="font-weight-bold"> {{ $result->agency->name }} </span>
												<span class="d-block"> {{ $result->agency->address_line_1 }} </span>
												<span class="d-block"> {{ $result->agency->address_line_2 }} </span>
												<span class="d-block"> {{ $result->agency->city.', '.$result->agency->state }} </span>
												<span class="d-block"> {{ $result->agency->country_code.', '.$result->agency->postal_code }} </span>
												<span class="d-block"> {{ $result->agency->mobile_number }} </span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="card-body">
									<div class="separator-solid"></div>
									<div class="row">
										<div class="col-md-4 info-invoice">
											<h5 class="sub"> @lang("admin_messages.invoice_details.invoice_date") </h5>
											<p> {{ $result->invoice_date_formatted }} </p>
										</div>
										<div class="col-md-4 info-invoice">
											<h5 class="sub"> @lang("admin_messages.invoice_details.invoice_number") </h5>
											<p>#{{ $result->invoice_number }}</p>
										</div>
										<div class="col-md-4 info-invoice">
											<h5 class="sub"> @lang("admin_messages.status") </h5>
											<p> {{ $result->status }} </p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="invoice-detail">
												<div class="invoice-top">
													<h3 class="title"><strong> @lang("admin_messages.invoice_details.invoice_summary") </strong></h3>
												</div>
												<div class="invoice-item">
													<div class="table-responsive">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th class="font-weight-bold"> # </th>
																	<th class="text-center">  @lang("admin_messages.invoice_details.item") </th>
																	<th class="text-center">  @lang("admin_messages.invoice_details.price") </th>
																	<th class="text-center">  @lang("admin_messages.invoice_details.quantity") </th>
																	<th class="text-center">  @lang("admin_messages.invoice_details.discount") </th>
																	<th class="text-center">  @lang("admin_messages.invoice_details.total") </th>
																</tr>
															</thead>
															<tbody>
																@foreach($result->invoice_items as $invoice_item)
																	<tr>
																		<th class="font-weight-bold"> {{ $loop->iteration }} </th>
																		<td class="text-center"> {{ $invoice_item->name }} </td>
																		<td class="text-center"> {{ $currency_symbol }} {{ $invoice_item->price }} </td>
																		<td class="text-center"> {{ $invoice_item->quantity }} </td>
																		<td class="text-center"> {{ $currency_symbol }} {{ $invoice_item->discount }} </td>
																		<td class="text-center"> {{ $currency_symbol }} {{ $invoice_item->total }} </td>
																	</tr>
																@endforeach																
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="separator-solid  mb-3"></div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="row">
										<div class="col-sm-7 col-md-5 mb-3 mb-md-0 transfer-to">
											
										</div>
										<div class="col-sm-5 col-md-7 transfer-total">
											<table class="table table-clear">
												<tbody>
													<tr>
														<td class="left">
															<span class="font-weight-bolder"> Sub total </span>
														</td>
														<td class="empty-row"> </td>
														<td class="right"> {{ $currency_symbol }} {{ $result->discount_sub_total }} </td>
													</tr>
													@foreach($result->invoice_taxes as $invoice_tax)
													<tr>
														<td class="left">
															<span class="font-weight-bolder"> {{ $invoice_tax->name }} </span>
														</td>
														<td class="empty-row"> {{ $invoice_tax->tax_value }} </td>
														<td class="right">
															{{ $currency_symbol }} {{ $invoice_tax->amount }}
														</td>
													</tr>
													@endforeach
													<tr>
														<td class="left">
															<div class="sub"> Total Amount </div>
														</td>
														<td class="empty-row"> </td>
														<td class="right">
															<span class="font-weight-bold">  </span>
															<div class="price"> {{ $currency_symbol }} {{ $result->total }} </div>
														</td>
													</tr>
												</tbody>
											</table>											
										</div>
									</div>
									<div class="separator-solid"></div>
									<h6 class="text-uppercase mt-4 mb-3 fw-bold">
									Notes
									</h6>
									<p class="text-muted mb-0">
										We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
	function printInvoice()
	{
		var printContents = document.getElementById("invoice").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>
@endpush