<!--
    dev: Oscar Peralta
    date 2019
-->
@extends("admin.layout.main")

    @section("titulo")
    <title>SIG | Inicio</title>
    @endsection
 
          @section("contenido")
          <div class="m-content">

            <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="formulario-editar-bienvenida">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Bienvenida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">            
                      <textarea class="form-control" rows="6" name ="bienvenida">{{$inicio->bienvenida}}</textarea>
                     <input type="hidden" name = "id" value = "{{$inicio->id}}">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                  </div>
                </div>
                </form>
              </div>
            </div>

            <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="formulario-editar-politica">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Politica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">            
                      <textarea class="form-control" rows="6" name ="politica" id = "editar-correo">{{$inicio->politica}}</textarea>
                     <input type="hidden" name = "id" value = "{{$inicio->id}}">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                  </div>
                </div>
                </form>
              </div>
            </div>

            <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="formulario-editar-mision">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Mision</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">            
                      <textarea class="form-control" rows="6" name ="mision" id = "editar-correo">{{$inicio->mision}}</textarea>
                     <input type="hidden" name = "id" value = "{{$inicio->id}}">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                  </div>
                </div>
                </form>
              </div>
            </div>

            <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="formulario-editar-vision">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Vision</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">            
                      <textarea class="form-control" rows="6" name ="vision">{{$inicio->vision}}</textarea>
                     <input type="hidden" name="id" value = "{{$inicio->id}}">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                  </div>
                </div>
                </form>
              </div>
            </div>

           <div class="row">
              <div class="col-lg-6">

                  <div class="m-portlet m-portlet--warning m-portlet--head-solid-bg m-portlet--rounded">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                          <i class="la la-thumb-tack"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                          BIENVENIDA
                        </h3>
                      </div>
                    </div>
                    <div class="m-portlet__head-tools">
                      <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                          <button class="m-portlet__nav-link btn btn-secondary m-btn m-btn--air m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal" data-target="#m_modal_1">
                            <i class="la la-edit"></i>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <p align="justify">{{$inicio->bienvenida}}</p>
                  </div>
                </div>
              </div>
                <div class="col-lg-6">

                <div class="m-portlet m-portlet--warning m-portlet--head-solid-bg m-portlet--rounded">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                          <i class="flaticon-globe"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                          POLITICA
                        </h3>
                      </div>
                    </div>
                    <div class="m-portlet__head-tools">
                      <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                          <button class="m-portlet__nav-link btn btn-secondary m-btn m-btn--air m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal" data-target="#m_modal_2">
                            <i class="la la-edit"></i>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <p align="justify">{{$inicio->politica}}</p>
                  </div>
                </div>
              </div>
                <div class="col-lg-6">
                      <div class="m-portlet m-portlet--warning m-portlet--head-solid-bg m-portlet--rounded">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                          <i class="flaticon-medal"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                          MISION
                        </h3>
                      </div>
                    </div>
                    <div class="m-portlet__head-tools">
                      <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                          <button class="m-portlet__nav-link btn btn-secondary m-btn m-btn--air m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal" data-target="#m_modal_3">
                            <i class="la la-edit"></i>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <p align="justify">{{$inicio->mision}}</p>
                  </div>
                </div>
              </div>
                <div class="col-lg-6">

                      <div class="m-portlet m-portlet--warning m-portlet--head-solid-bg m-portlet--rounded">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                          <i class="flaticon-medical"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                         VISION
                        </h3>
                      </div>
                    </div>
                    <div class="m-portlet__head-tools">
                      <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                          <button class="m-portlet__nav-link btn btn-secondary m-btn m-btn--air m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal" data-target="#m_modal_4">
                            <i class="la la-edit"></i>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <p align="justify">{{$inicio->vision}}</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        

           @endsection

           @section("subtitulo")
           <h3 class="m-subheader__title m-subheader__title--separator">Inicio</h3>
           @endsection
       
    @section("js")
    <script src="/SIG/js/admin/editarInicio.js" type="text/javascript"></script>
    @endsection
