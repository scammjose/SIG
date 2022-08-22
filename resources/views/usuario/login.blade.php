<!--
    dev: Claudia Altamirano
    date 2019
-->
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Login | Usuario</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		<link href="/SIG/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/SIG/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="/SIG/assets/img/logo.png" />

	</head>
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(/SIG/assets/img/fondo-ciudad.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="/SIG/assets/img/logo.png" >
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">SISTEMA INTEGRAL DE GESTION</h3>
							</div>
							<form class="m-login__form m-form" action=""id="form-login-usuario">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="email" placeholder="Correo institucional" name="correo" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Constraseña" name="password">
								</div>
								
								<div class="m-login__form-action">
									<input type="submit" id="m_login_signin_submit" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" value = "Iniciar Sesion">
								</div>
							</form>
						</div>
			
					</div>
				</div>
			</div>
		</div>
		<script src="/SIG/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/SIG/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<script src="/SIG/js/usuario/login.js" type="text/javascript"></script>
		<script src="/SIG/js/sweetalert.js" type="text/javascript"></script>
	</body>
</html>