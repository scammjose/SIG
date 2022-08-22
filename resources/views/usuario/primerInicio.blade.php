<!--
    dev: Claudia Altamira
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
                <div class="m-grid__item m-grid__item--fluid    m-login__wrapper">
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
                            <form class="m-login__form m-form" action="" id="form-primer-inicio">
                                <input type="hidden" name="usuarios-id" id="usuarios-id">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Nombre" name="nombre"  value = "{{$usuarios->nombre}}" readonly>
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Apellido Parteno" name="apellidoPaterno" value ="{{$usuarios->apellidoPaterno}}"readonly>
                                </div>
                                 <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Apellido Materno" name="apellidoMaterno" value ="{{$usuarios->apellidoMaterno}}"readonly>
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="hidden" placeholder="Tipo" name="tipo" value="{{$usuarios->tipo}}" readonly>
                                           @if($usuarios->tipo == 1)
                                                <input class="form-control m-input" type="text" value="Con privilegios" readonly>
                                           @else
                                                <input class="form-control m-input" type="text" value="Estandar" readonly>
                                           @endif
                                </div>
                              
                                <input type="hidden" name = "id" value="{{$usuarios->id}}">
                                <input type="hidden" name ="estatus" value="1">
                                <input type="hidden" name = "codigo" value="{{$usuarios->codigo}}">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Correo" name="correo" value="{{$usuarios->correo}}"readonly>
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="password" placeholder="Nueva Contraseña" name="password" id= "password-1">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirmar Contraseña"  id="password-2"><br>
                                </div>
                                <div class="m-login__action">
                                <div class="row">
                                      <div class="col-md-4"></div> 
                                      <div class="col-md-4">
                                    <input type="submit" id="m_login_signin_submit" class="btn m-btn--pill btn-lg btn-block  btn-outline-metal activee" value="Aceptar" >
                                 </div>
                                </div>
                                </div>
                            </form> 
                       </div>
            
                    </div>
                </div>
            </div>
        </div>
        <script src="/SIG/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="/SIG/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <script src="/SIG/js/usuario/primerInicio.js" type="text/javascript"></script>
        <script src="/SIG/js/sweetalert.js" type="text/javascript"></script>
    </body>
</html>