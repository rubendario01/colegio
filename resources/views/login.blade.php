<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>DevOOPS</title>
		<meta name="description" content="description">
		<meta name="author" content="Evgeniya">
		<meta name="keyword" content="keywords">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="/css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body style="background-image:url('img/fondo.jpg');background-repeat: no-repeat;
background-size: 120% auto;
background-position: center;">
<div class="container-fluid">
    <br><br>
	<div class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="text-right">
				{{-- <a href="page_register.html" class="txt-default">Need an account?</a> --}}
			</div>
			<br>
			<br>
			<br>
			<br>
			<form action="/sesion" method="post">
				@csrf
				<div class="card" style="border:none !important; border-width:0">
					<div class="card-content" style="background:rgba(255, 0, 0, 0) !important;border:none !important; border-width:0">
						<div class="text-center">
							<h2 style="color:white;" class="b mb-3">Inicio de sesión</h2>
							<br>
						</div>
						<div class="form-group">
							<label style="color:white; font-size:20px" class="control-label">Usuario</label>
							<input type="text" class="form-control" name="name" />
						</div>
						<div class="form-group">
							<label style="color:white; font-size:20px" class="control-label">Contraseña</label>
							<input type="password" class="form-control" name="password" />
						</div>
						<div class="text-center">
							<button class="btn btn-danger btn-lg">Ingresar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
