<!--
    dev: Oscar Peralta
    date 2019
-->
@extends("admin.layout.main")

    @section("titulo")
    <title>SIG | Administrador</title>
    @endsection
 
          @section("contenido")
          <br>
           
            <div class="m-portlet m-portlet--mobile">
              <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                  <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                      Usuarios
                    </h3>
                  </div>
                </div>
                <div class="m-portlet__head-tools">
                  <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                      <button type="button" class="btn m-btn--pill btn-outline-warning m-btn m-btn--custom m-btn--outline-2x" data-toggle="modal" data-target="#m_modal_1">
                        <span>
                          <i class="la la-plus"></i>
                          <span>Agregar Usuario</span>
                        </span>
                      </button>
                    </li>
                    <li class="m-portlet__nav-item"></li>
                 
                  </ul>
                </div>
              </div>
              <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Correo</th>
                      <th>Tipo</th>
                      <th>Reiniciar cuenta</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($usuario as $usuarios)
                    <tr>
                      <td>{{$usuarios->id}}</td>
                      <td>{{$usuarios->nombre}}</td>
                      <td>{{$usuarios->apellidoPaterno}}</td>
                      <td>{{$usuarios->apellidoMaterno}}</td>
                      <td>{{$usuarios->correo}}</td>
                      <td>{{$usuarios->tipo}}</td>
                      <td><button class= "btn m-btn--square btn-warning" onclick = "resetarCuenta({{$usuarios->id}},'{{$usuarios->nombre}}','{{$usuarios->apellidoPaterno}}','{{$usuarios->apellidoMaterno}}','{{$usuarios->correo}}','{{$usuarios->tipo}}','{{$usuarios->codigo}}')" data-toggle="modal" data-target="#m_modal_4">Reinicar cuenta</button></td>
                      <td  class= "usuario" usuarioId = "{{$usuarios->id}}" usuarioEliminar= "{{$usuarios->id}}" usuarioNombre= "{{$usuarios->nombre}}" usuarioAP = "{{$usuarios->apellidoPaterno}}" usuarioAM = "{{$usuarios->apellidoMaterno}}" usuarioPassword = "{{$usuarios->password}}" usuarioCorreo = "{{$usuarios->correo}}" usuarioTipo = "{{$usuarios->tipo}}" usuarioCodigo= "{{$usuarios->codigo}}" nowrap>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <input type="hidden" id="temporal-usuario-id">
              <input type="hidden" id="temporal-usuario-nombre">
              <input type="hidden" id="temporal-usuario-ap">
              <input type="hidden" id="temporal-usuario-am">
              <input type="hidden" id="temporal-usuario-correo">
              <input type="hidden" id="temporal-usuario-tipo">
              <input type="hidden" id="temporal-usuario-codigo">
              <input type="hidden" id="temporal-usuario-password">
              <input type="hidden" id="temporal-usuario-eliminar">
            
            <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="formulario-agregar-usuario">
                <div class="modal-content">
                  <div class="modal-body">   
                  <div class="m-portlet">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                          <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                          Agregar Nuevo Usuario 
                        </h3>
                      </div>
                    </div>
                  </div>
                    <div class="m-portlet__body">
                      <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group">
                           <label for="recipient-name" class="form-control-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" id="" required>
                            <br>
                            <div class="row"> 
                              <div class="col-md-6">
                              <label for="recipient-name" class="form-control-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" name="apellidoPaterno" id="" placeholder="Ej: Rodríguez " required>
                            </div>
                            <div class="col-md-6">
                              <label for="recipient-name" class="form-control-label">Apellido Materno:</label>
                            <input type="text" class="form-control" name="apellidoMaterno" id="" placeholder="Ej: Rodríguez" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group m-form__group">
                          <label>Correo Electronico:</label>
                          <input type="email" class="form-control m-input" name="correo" placeholder="Correo Electronico" required> 
                        </div>
                        <input type="hidden" class="form-control" name="codigo" value = "7">
                         <select class="form-control" name="tipo">
                          <option class="form-control" id="" value="1">normal</option>
                          <option class="form-control" id="" value="2">Con Privilegios</option>
                          </select>                           
                            <input type="hidden" class="form-control" name="estatus" id="" value = "0">     
                      </div>
                    </div>
                </div>         
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                  </div>
                </div>
                </form>
              </div>
            </div>

              <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="formulario-editar-usuario">
                <div class="modal-content">
                  <div class="modal-body">   
                  <div class="m-portlet">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                          <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                          Editar Usuario 
                        </h3>
                      </div>
                    </div>
                  </div>
                    <div class="m-portlet__body">
                      <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group">
                           <label for="recipient-name" class="form-control-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" id="nombre-usuario" required>
                            <br>
                            <div class="row"> 
                              <div class="col-md-6">
                              <label for="recipient-name" class="form-control-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" name="apellidoPaterno" id="ap-usuario"required>
                            </div>
                            <div class="col-md-6">
                              <label for="recipient-name" class="form-control-label">Apellido Materno:</label>
                            <input type="text" class="form-control" name="apellidoMaterno" id="am-usuario" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group m-form__group">
                          <label>Correo Electronico:</label>
                          <input type="email" class="form-control m-input" id="correo-usuario" vlaue="correo-usuario" name="correo"> 
                        </div>
                        <input type="hidden" class="form-control" name="codigo" id="codigo-usuario">
                         <select class="form-control" name="tipo" id="tipo-usuario">
                          <option class="form-control" value="1">normal</option>
                          <option class="form-control" value="2">Con Privilegios</option>
                          </select>
                           <input type="hidden" class="form-control" name="password" id="password-usuario">
                            <input type="hidden" class="form-control" name="estatus" id="estatus-usuario" value = "0"> 
                            <input type="hidden" class="form-control" name="id" id="id-usuario">      
                      </div>
                    </div>
                </div>         
                  </div>
                  <div class="modal-footer">
                    <button type="button" id = "botonLimpiar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" >Guardar Cambios</button>
                  </div>
                </div>
                </form>
              </div>
            </div>


            <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form id="formulario-eliminar-usuario">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar Usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"><p>Esta seguro de Eliminar este registro?.</p> </div>
                    <input type="hidden" value = "" id="usuario-eliminar" name="id">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-success">Eliminar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form id="formulario-reiniciar-usuario">
                    <div class="modal-header">
                      <h5 class="modal-title">¿Desea reiniciar esta cuenta?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"><p>Asignara una contraseña por default (sigupt2021)</p> </div>
                    
                    <input type="hidden" name ="id" id="usuario-id-reset">
                    <input type="hidden" name = "nombre" id="usuario-nombre-reset">
                    <input type="hidden" name = "apellidoPaterno" id="usuario-ap-reset">
                    <input type="hidden" name = "apellidoMaterno" id="usuario-am-reset">
                    <input type="hidden" name = "codigo" id="usuario-codigo-reset">
                    <input type="hidden" name = "correo" id="usuario-correo-reset">
                    <input type="hidden" name = "password" value= $2y$10$fPpfbHm2ZIucSbrUpno1pOqZLkyWUjnYCQfkaci1krYMpbWMVOFHe">
                    <input type="hidden" name= "estatus" value="0">
                    <input type="hidden" name= "tipo" id="usuario-tipo-reset">
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
           @endsection

           @section("subtitulo")
           <h3 class="m-subheader__title m-subheader__title--separator">Administracion de Usuarios</h3>
           @endsection
       
    @section("js")
    <script src="/SIG/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/SIG/js/admin/datatables/tablaUsuarios.js" type="text/javascript"></script>
    <script src="/SIG/js/admin/usuarios.js" type="text/javascript"></script>
    @endsection
