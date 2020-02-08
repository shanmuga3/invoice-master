<!-- Classic Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['url' => '#', 'class' => 'form-horizontal','id'=>'common_delete-form','method' => "DELETE"]) !!}
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin_messages.confirm_delete') </h5>
				<button type="button" class="close btn btn-link" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<p> @lang('admin_messages.delete_desc') </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">
				@lang('admin_messages.cancel')
				</button>
				<button type="submit" class="btn btn-link btn-danger">
				@lang('admin_messages.proceed')
				</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>