<div class="card-body">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-invoice">
				<h3 class="text-center mt-4"> Tax Invoice </h3>
				<div class="card-header">
					<div class="invoice-header">
						<div class="invoice-agency">
							<img src="http://demo.themekita.com/azzara/livepreview/assets/img/examples/logoinvoice.svg" alt="company logo">
							<div class="invoice-desc">
								Bandung, West Java, Indonesia<br/>
								Fax 621113
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="separator-solid"></div>
					<div class="row">
						<div class="col-md-4 info-invoice">
							<h5 class="sub">Date</h5>
							<p>Dec 21, 2017</p>
						</div>
						<div class="col-md-4 info-invoice">
							<h5 class="sub">Invoice ID</h5>
							<p>#FDS9876KD</p>
						</div>
						<div class="col-md-4 info-invoice">
							<h5 class="sub">Invoice To</h5>
							<p>
								Jane Smith, 1234 Main, Apt. 4B<br/>Springfield, ST 54321
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="invoice-detail">
								<div class="invoice-top">
									<h3 class="title"><strong>Order summary</strong></h3>
								</div>
								<div class="invoice-item" ng-init="invoice_items={{ json_encode(['id' => '']) }}">
									<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
													<td><strong>Item</strong></td>
													<td class="text-center"><strong>Price</strong></td>
													<td class="text-center"><strong>Quantity</strong></td>
													<td class="text-center"><strong> Tax </strong></td>
													<td class="text-center"><strong> Discount </strong></td>
													<td class="text-right"><strong>Totals</strong></td>
												</tr>
											</thead>
											<tbody>
												<tr ng-repeat="invoice_item in invoice_items">
													<td class="text-center"> <input type="text" name="invoice_item[]" ng-model="invoice_item.name"> </td>
													<td class="text-center"> <input type="text" name="invoice_item[]" ng-model="invoice_item.price"> </td>
													<td class="text-center"> <input type="text" name="invoice_item[]" ng-model="invoice_item.quantity"> </td>
													<td class="text-center"> <input type="text" name="invoice_item[]" ng-model="invoice_item.tax"> </td>
													<td class="text-center"> <input type="text" name="invoice_item[]" ng-model="invoice_item.discount"> </td>
													<td class="text-center"> <input type="text" name="invoice_item[]" ng-model="invoice_item.total"> </td>
												</tr>
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
							<h5 class="sub">Total Amount</h5>
							<div class="price">$685.99</div>
							<span>Taxes Included</span>
						</div>
					</div>
					<div class="separator-solid"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-action">
	<button type="submit" class="btn btn-success float-right"> @lang('admin_messages.submit') </button>
	<a class="btn btn-danger" href="{{ route('admin.invoice') }}"> @lang('admin_messages.cancel') </a>
</div>