<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
 @yield("titulo")
    <meta name="description" content="Blank inner page examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="/SIG/assets/demo/demo11/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/SIG/assets/img/logo.png" />

  </head>
  <body class="m-content--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
      <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
          <div class="m-stack m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-brand  m-brand--skin-light ">
              <div class="m-stack m-stack--ver m-stack--general m-stack--fluid" >
                <div class="m-stack__item m-stack__item--middle m-brand__logo" >
                  <a href="/SIG/admin/inicio" class="m-brand__logo-wrapper">
                    <img alt="" src="/SIG/assets/img/logo.png" />
                  </a>
                </div>
              </div>
            </div>
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
              <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                <div class="m-stack__item m-topbar__nav-wrapper">
                  <ul class="m-topbar__nav m-nav m-nav--inline">
                    <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown"
                     m-dropdown-persistent="1">
                      <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-nav__link-icon">
                          <span class="m-nav__link-icon-wrapper">
                            <i class="flaticon-search-1"></i>
                          </span>
                        </span>
                      </a>
                      <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                        <div class="m-dropdown__inner ">
                          <div class="m-dropdown__header">
                            <form class="m-list-search__form">
                              <div class="m-list-search__form-wrapper">
                                <span class="m-list-search__form-input-wrapper">
                                  <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
                                </span>
                                <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                  <i class="la la-remove"></i>
                                </span>
                              </div>
                            </form>
                          </div>
                          <div class="m-dropdown__body">
                            <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                              <div class="m-dropdown__content">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                      <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-topbar__userpic">
                          <img src="/SIG/panel/img/avatar5.png" class="m--img-rounded m--marginless m--img-centered" alt="" />
                        </span>
                        <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                          <span class="m-nav__link-icon-wrapper">
                            <i class="flaticon-user-ok"></i>
                          </span>
                        </span>
                        <span class="m-topbar__username m--hide">Nick</span>
                      </a>
                      <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                          <div class="m-dropdown__header m--align-center">
                            <div class="m-card-user m-card-user--skin-light">
                              <div class="m-card-user__pic">
                                <img src="/SIG/panel/img/avatar5.png" class="m--img-rounded m--marginless" alt="" />
                              </div>
                              <div class="m-card-user__details">
                                <span class="m-card-user__name m--font-weight-500">Administrador</span>
                                <a href="" class="m-card-user__email m--font-weight-300 m-link">{{$administra->correo}}</a>
                              </div>
                            </div>
                          </div>
                          <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                              <ul class="m-nav m-nav--skin-light">
                                <li class="m-nav__section m--hide">
                                  <span class="m-nav__section-text">Section</span>
                                </li>
                                <li class="m-nav__separator m-nav__separator--fit">
                                </li>
                                <li class="m-nav__item">
                                  <a href="{{url('admin/logout/')}}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Cerrar Sesion</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
          <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">
          <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
              <li class="m-menu__section m-menu__section--first">
                <h4 class="m-menu__section-text">Panel de Control</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
              </li>
              <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{url('/admin/inicio/')}}" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-presentation "></i>
                  <span class="m-menu__link-text">Inicio</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                     <a href="javascript:;" class="m-menu__link m-menu__toggle">
                  <i class="m-menu__link-icon flaticon-interface-6"></i>
                  <span class="m-menu__link-text">Usuarios</span>
                  <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                  <span class="m-menu__arrow"></span>
                  <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                      <span class="m-menu__link">
                        <span class="m-menu__link-text">Usuarios</span>
                      </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                      <a href="{{url('/admin/usuario/')}}" class="m-menu__link ">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                          <span></span>
                        </i>
                        <span class="m-menu__link-text">Agregar Nuevo Usuario</span>
                      </a>
                    </li>
                       
                    <li class="m-menu__item " aria-haspopup="true">
                     <a href="{{url('/admin/movimientos/')}}" class="m-menu__link ">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                          <span></span>
                        </i>
                        <span class="m-menu__link-text">Movimientos de Usuario</span>
                      </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                     <a href="{{url('/admin/inicios-de-sesion/')}}" class="m-menu__link ">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                          <span></span>
                        </i>
                        <span class="m-menu__link-text">Inicios de Sesion</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="m-menu__section m-menu__section--first">
                <h4 class="m-menu__section-text">Archivos y Documentacion</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
              </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                  <i class="m-menu__link-icon flaticon-interface-6"></i>
                  <span class="m-menu__link-text">Categoria</span>
                  <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                  <span class="m-menu__arrow"></span>
                  <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                      <span class="m-menu__link">
                        <span class="m-menu__link-text">Categoria</span>
                      </span>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                      <a href="#" class="m-menu__link "data-toggle="modal" data-target="#m_modal_agregar_categoria">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                          <span></span>
                        </i>
                        <span class="m-menu__link-text"><b>Agregar Nueva Categoria</b></span>
                      </a>
                    </li>
                 @foreach($categoria as $categ)
                    <li class="m-menu__item " aria-haspopup="true">
                     <a href="{{url('/admin/categoria/'.$categ->id.'')}}" class="m-menu__link " >
                          <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="m-menu__link-text">{{$categ->nombre}}</span>
                      </a>
                    </li>
                @endforeach
                  </ul>
                </div>
              </li>
              <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{url('/admin/archivo/')}}" class="m-menu__link ">
                  <i class="m-menu__link-icon  flaticon-list-1 "></i>
                  <span class="m-menu__link-text">Archivos</span>
                </a>
              </li>
         

            </ul>
          </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
          <div class="m-subheader ">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                @yield("subtitulo")
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                  <li class="m-nav__item m-nav__item--home">
                    <a href="{{url('/admin/dashboard/')}}" class="m-nav__link m-nav__link--icon">
                      <i class="m-nav__link-icon la la-home"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="modal fade" id="m_modal_agregar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formulario-agregar-categoria">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="" required>
                      </div>
                    
                      <input type="hidden" class="form-control" name="posicion" value="7" id ="">
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>

                </form>
              </div>   
        </div>
    </div>
         @yield("contenido")
        </div>
       
      </div>
      <footer class="m-grid__item   m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
          <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
              <span class="m-footer__copyright">
                2019 &copy; Universidad Politénica de Tecámac
                <a href="http://uptecamac.edomex.gob.mx/" class="m-link">Pagina Oficial</a>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script src="/SIG/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="/SIG/assets/demo/demo11/base/scripts.bundle.js" type="text/javascript"></script>
    <script src="/SIG/js/admin/agregarCategoria.js" type="text/javascript"></script>
   @yield("js")
  </body>
</html>