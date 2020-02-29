<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Login</title>
		<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
		<!-- Fonts and icons -->
		<script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
		<script>
			WebFont.load({
				google: {"families":["Open+Sans:300,400,600,700"]},
				custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['css/fonts.css']},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		
		<!-- CSS Files -->
		<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('admin_assets/css/login.css') }}">
	</head>
	<body class="login">
		<div class="wrapper wrapper-login" style="background-image: url('{{ asset('images/sliders/slider_2.jpg') }}')">
			{!! Form::open(['url' => route('admin.authenticate'), 'class' => 'form-horizontal','id'=>'login-form','method' => "POST"]) !!}
			<div class="container container-login animated fadeIn">
				<h3 class="text-center">Sign In To Admin</h3>
				<div class="login-form">
					<div class="form-group form-floating-label">
						<input id="username" name="username" type="text" class="form-control input-border-bottom" value="admin" required>
						<label for="username" class="placeholder">Username</label>
					</div>
					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" class="form-control input-border-bottom" value="12345678" required>
						<label for="password" class="placeholder">Password</label>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
					<div class="row form-sub m-0">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="rememberme">
							<label class="custom-control-label" for="rememberme">Remember Me</label>
						</div>
					</div>
					<div class="form-action mb-3">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In </button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
		<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
		<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('js/core/popper.min.js') }}"></script>
		<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
		@if(Session::has('message'))
		<script type="text/javascript">
			$(document).ready(function() {
				var content = {};
				state = "{!! Session::get('state') !!}";
				content.message = "{!! Session::get('message') !!}";
				content.title = "{!! Session::get('title') !!}";
								content.icon = 'fa fa-bell';
				$.notify(content,{
					type: state,
					placement: {
						from: "top",
						align: "center"
					},
					time: 2000,
					delay: 0,
				});
			});
		</script>
		@endif
		<script type="text/javascript">
			$(document).on('click','.show-password',function() {
				$(this).toggleClass('active');
		        var type = $(this).hasClass('active') ? 'text' : 'password';
		        $('#password').attr("type",type);
			});
		</script>
	</body>
</html>