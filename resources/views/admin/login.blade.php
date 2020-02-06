<!DOCTYPE html>
<html>
	<head>
		<title> Invoice Master </title>
		<meta charset="utf-8" />
		<link rel="apple-touch-icon" sizes="76x76" href="{{ $favicon ?? '' }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="shortcut icon" href="{{ $favicon ?? '' }}">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
		<!--     Fonts and icons     -->
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
		<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('admin_assets/css/login.css') }}">
	</head>
	<body>
	@if(session()->has('message'))
    <div class="flash-container w-100 text-center alert {{ session('alert-class') }}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span> {{ session('message') }} </span>
    </div>
    @endif
		<div class="wrapper">
			<div class="carousel slide" data-ride="carousel" data-interval="8000">
				<div class="carousel-inner">
					<div class="carousel-item active" style="background-image: url('{{ asset('images/sliders/slider_1.jpg') }}')">
					</div>
					<div class="carousel-item" style="background-image: url('{{ asset('images/sliders/slider_2.jpg') }}')">
					</div>
					<div class="carousel-item" style="background-image: url('{{ asset('images/sliders/slider_3.jpg') }}')">
					</div>
					<div class="carousel-item" style="background-image: url('{{ asset('images/sliders/slider_4.jpg') }}')">
					</div>
				</div>
			</div>
			<div class="login-container">
				{!! Form::open(['url' => route('admin.authenticate'), 'class' => 'form-horizontal','id'=>'login-form','method' => "POST"]) !!}
				<div class="card card-body p-4 m-4">
					<h3 class="mb-2 text-center"> Invoice Master </h3>
					<fieldset>
						<h3 class="text-center text-info">Login</h3>
						<div class="form-group">
							<label for="username" class="text-info">Username:</label><br>
							<input type="text" name="username" id="username" class="form-control">
							@if ($errors->has('username'))
			                  <div class="text-danger">
			                    {{ $errors->first('username') }}
			                  </div>
			                @endif
						</div>
						<div class="form-group">
							<label for="password" class="text-info">Password:</label><br>
							<input type="text" name="password" id="password" class="form-control">
							@if ($errors->has('password'))
			                  <div class="text-danger">
			                    {{ $errors->first('password') }}
			                  </div>
			                @endif
						</div>
						<div class="form-group text-center">
							<input type="submit" name="submit" class="btn btn-primary" value="submit">
						</div>
						{!! Form::close() !!}
					</fieldset>
				</div>				
			</div>
		</div>
		<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
		<script src="{{ asset('js/core/popper.min.js') }}"></script>
		<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
	</body>
</html>