<!--
    dev: Oscar Peralta
    date 2019
-->
@extends("admin.layout.main")

    @section("titulo")
    <title>SIG | Archivos</title>
    @endsection
 
          @section("contenido")

         <br>
           
            <div class="m-portlet m-portlet--mobile">
              <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                  <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                      Archivos
                    </h3>
                  </div>
                </div>
                <div class="m-portlet__head-tools">
                  <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                      <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x" data-toggle="modal" data-target="#m_modal_1">
                        <span>
                          <i class="la la-plus"></i>
                          <span>Agregar Archivo</span>
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
                      <th>Tipo</th>
                      <th>Ubicacion</th>
                      <th>Tipo de acceso</th>
                      <th>Mover</th>
                      <th>Editar/Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($archivo as $archive)
                    <tr>
                      <td>{{$archive->id}}</td>
                      <td>{{$archive->slug}}</td>
                      <td>{{$archive->tipo}}</td>
                      <td style="width: 100px;"><a target="_blank" href="/SIG/{{$archive->src_archivo}}{{$archive->slug}}">{{$archive->src_archivo}}{{$archive->slug}}</a></td>
                      <td>{{$archive->visible}}</td>
                      <td class="cambiarArchivo" idArchivo="{{$archive->id}}"><button class= "btn m-btn--square btn-danger "  data-toggle="modal" data-target="#m_modal_2">Mover a Carpeta</button></td>
                      <td class="archivo" idEditar="{{$archive->id}}" nombre="{{$archive->nombre}}" tipo="{{$archive->tipo}}" categoria="{{$archive->categoriaId}}" visible="{{$archive->visible}}" eliminar="{{$archive->id}}" nowrap> 
                    </tr>
                    @endforeach
                 
                  </tbody>
                </table>
              </div>
              <input type="hidden" id="temporal-cambiar-id">
              <input type="hidden" id="temporal-editar-id">
              <input type="hidden" id="temporal-editar-nombre">
              <input type="hidden" id = "temporal-editar-tipo">
              <input type="hidden" id = "temporal-editar-categoria">
              <input type="hidden" id = "temporal-editar-visible">
              
            </div>


                <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form id="registrar-archivo" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title">Agregar nuevo Archivo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">  
                      <div class="form-group m-form__group">
                          <label>Nombre:</label>
                          <input type="text" class="form-control m-input" id="nombre" name="nombre" required> 
                      </div> 
                         <label>Tipo:</label>
                        <select class="form-control" name="tipo" id="tipo-usuario">
                          <option class="form-control" value="1">normal</option>
                          <option class="form-control" value="2">Complementario</option>
                        </select>
                          <label>Categoria:</label>
                        <select class="form-control" name="categoriaId" id="select-categoria">
                          <option class="form-control" value="0">Seleccione Categoria</option>
                            @foreach($categoria as $catego)
                          <option class="form-control" value="{{$catego->id}}">{{$catego->nombre}}</option>
                          @endforeach
                        </select>
                          <label>Subcategoria:</label>
                        <select class="form-control" name="subcategoriaId"  id="select-subcategoria">
                        </select>
                           <label>Restricciones:</label>
                        <select class="form-control" name="visible" id="tipo-usuario">
                          <option class="form-control" value="1">Solo yo</option>
                          <option class="form-control" value="2">Yo y usuarios con privilegios</option>
                          <option class="form-control" value="3">Todos</option>
                        </select> 
                          <br> 
                          <label>Elige archivo:</label>
                          <input id = "entrada-archivo" name="entradaArchivo[]"type="file"multiple class="file-loading" data-show-preview="false">
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form id="mover-archivo">
                    <div class="modal-header">
                      <h5 class="modal-title">Mover Archivo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">  
   
                           <label>Eliga Carpeta Destino</label>
                        <select class="form-control" name="mover" id="mover-carpeta">
                          <option class="form-control" value="1">Carpeta Derogados</option>
                          <option class="form-control" value="2">Carpeta Obsoletos</option>
                          <option class="form-control" value="3">Carpeta Archivos Fuente</option>
                        </select> 
                         <input type="hidden" name="id" id="archivo-nuevo-id">
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form id="editar-archivo">
                    <div class="modal-header">
                      <h5 class="modal-title">Editar Archivo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">  
                      <div class="form-group m-form__group">
                          <label>Nombre:</label>
                          <input type="text" class="form-control m-input" id="nombre-archivo" name="nombre" required> 
                          <input type="hidden" id="nombre-id" name="id"> 
                      </div> 
                         <label>Tipo:</label>
                        <select class="form-control" name="tipo" id="editar-tipo">
                          <option class="form-control" value="1">normal</option>
                          <option class="form-control" value="2">Complementario</option>
                        </select>
                          <label>Categoria:</label>
                        <select class="form-control" name="categoriaId" id="editar-categoria">
                          <option class="form-control" value="0">Seleccione Categoria</option>
                            @foreach($categoria as $catego)
                          <option class="form-control" onclick="editarSub({{$catego->id}})" value="{{$catego->id}}">{{$catego->nombre}}</option>
                          @endforeach
                        </select>
                          <label>Subcategoria:</label>
                        <select class="form-control" name="subcategoriaId"  id="editar-subcategoria">
                        </select>
                           <label>Restricciones:</label>
                        <select class="form-control" name="visible" id="editar-visible">
                          <option class="form-control" value="1">Solo yo</option>
                          <option class="form-control" value="2">Yo y usuarios con privilegios</option>
                          <option class="form-control" value="3">Todos</option>
                        </select> 
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
           @endsection
           @section("subtitulo")
           <h3 class="m-subheader__title m-subheader__title--separator">Archivos</h3>
           @endsection
       
    @section("js")
      <script src="/SIG/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
      <script src="/SIG/js/admin/datatables/tablaArchivos.js" type="text/javascript"></script>
      <script src="/SIG/js/admin/agregarArchivo.js" type="text/javascript"></script>
    @endsection
