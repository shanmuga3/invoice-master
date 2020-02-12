<div class="card-body">
	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label"> @lang('admin_messages.tax_type.name') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('name', @$result->name, ['class' => 'form-control input-square', 'id' => 'name']) !!}
			<span class="text-danger">{{ $errors->first('name') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="description" class="col-sm-2 col-form-label"> @lang('admin_messages.tax_type.description') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('description', @$result->description, ['class' => 'form-control input-square', 'id' => 'description']) !!}
			<span class="text-danger">{{ $errors->first('description') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="type" class="col-sm-2 col-form-label"> @lang('admin_messages.tax_type.type') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::select('type', array('percent' => Lang::get('admin_messages.tax_type.percent'), 'fixed' =>  Lang::get('admin_messages.tax_type.fixed')), @$result->type, ['class' => 'form-control py-0', 'id' => 'type', 'placeholder' => Lang::get("admin_messages.tax_type.type")]) !!}
			<span class="text-danger">{{ $errors->first('type') }}</span>
		</div>
	</div>
	<div class="form-group row">
		<label for="value" class="col-sm-2 col-form-label"> @lang('admin_messages.tax_type.value') <em class="text-danger">*</em></label>
		<div class="col-sm-10">
			{!! Form::text('value', $result->value, ['class' => 'form-control input-square', 'id' => 'value' ]) !!}
			<span class="text-danger">{{ $errors->first('value') }}</span>
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
	<a class="btn btn-danger" href="{{ $base_url }}"> @lang('admin_messages.cancel') </a>
</div>