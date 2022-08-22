<!--
    dev: Claudia Altamira
    date 2019
-->
@extends("usuario.layout.main")

@section("titulo")
<title>SIG | Categoria</title>
@endsection
 
@section("subtitulo")
  <h3 class="m-subheader__title m-subheader__title--separator">Categoria</h3>
@endsection

@section("contenido")       
  <br>
  <!-- categoria -->
 <div class="col-xl-12 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible  fade show" role="alert">
  @if($user->tipo == 2)
    <div class="m-dropdown " m-dropdown-toggle="hover">
      <a href="#" class=" btn btn-success " style="height: 78px">
        <i class="flaticon-folder"></i>
      </a>
      <div class="m-dropdown__wrapper">   
        <div class="m-dropdown__inner">
          <div class="m-dropdown__body">
            <div class="m-dropdown__content">
              <ul class="m-nav">
                <li class="m-nav__item">
                  <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x cat-editar"   idCat="{{$categorias->id}}"nomCat="{{$categorias->nombre}}">
                    <i class="m-nav__link-icon la la-edit"></i>
                    <span class="m-nav__link-text">Editar</span>
                  </button> 
                </li>
                <br>
                <li class="m-nav__item">
                  <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x" onclick="eliminarCategoria({{$categorias->id}})" >
                    <i class="m-nav__link-icon la la-trash"></i>
                    <span class="m-nav__link-text">Eliminar</span>      
                  </button> 
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="m-alert__text"><h2>{{$categorias->nombre}}</h2></div>
    <div class="m-alert__actions" style="width: 220px;">
      @if($user->tipo == 2)
      <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x" data-toggle="modal" data-target="#m_modal_agregar_subcategoria">
        <span>
          <i class="la la-plus"></i><span>Agregar Subcategoria</span>
        </span>
      </button>
      @endif
    </div>
  </div>
  <!-- categoria -->
  @foreach($subcategoria as $sub)
  
    <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head m-alert--outline alert-success" >
        @if($user->tipo == 2)
        <div class="m-dropdown " m-dropdown-toggle="hover">
          <a href="#" class=" btn success ">
            <i class="flaticon-folder"></i>
          </a>
          <div class="m-dropdown__wrapper">   
            <div class="m-dropdown__inner">
              <div class="m-dropdown__body">
                <div class="m-dropdown__content">
                  <ul class="m-nav">
                    <li class="m-nav__item">
                      <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x sub-editar" subId ="{{$sub->id}}" idNombre="{{$sub->nombre}}" data-toggle="modal" data-target="#m_modal_editar_subcategoria" ">
                        <i class="m-nav__link-icon la la-edit"></i>
                        <span class="m-nav__link-text">Editar</span>
                      </button> 
                    </li>
                    <br>
                    
                    <li class="m-nav__item">
                      <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x" onclick="eliminarSubcate({{$sub->id}},{{$categorias->id}})" >
                        <i class="m-nav__link-icon la la-trash"></i>
                        <span class="m-nav__link-text">Eliminar</span>      
                      </button> 
                    </li>
                   
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">Subcategoria: {{$sub->nombre}}</h3>
          </div>
        </div>
        @if($user->tipo == 2)
        <div class="m-portlet__head-tools">
          <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
              <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m-btn--outline-2x sub-id" data-toggle="modal" data-target="#m_modal_2" idSub="{{$sub->id}}">
                <span>
                  <i class="la la-plus"></i><span>Agregar Archivo</span>
                </span>
              </button>
            </li>
            <li class="m-portlet__nav-item"></li>
          </ul>
        </div>
        @endif
      </div>
      <div class="m-portlet__body table-responsive"> 
            <table class="table table-striped- table-bordered table-hover table-checkable tabla_1" id="m_table_1">  
          <thead>
            <tr>
              <th colspan="2">Archivos Normales</th>
            </tr>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descargar</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>  
          </thead>
          <tbody>
         @foreach($archivosYo as $archivo)
          @if($archivo->tipo == 1 && $archivo->n_subcategoria == $sub->nombre) 
          <tr>
            <td>{{$archivo->id}}</td>
             <td>{{$archivo->slug}}</td>
             <td style="width: 350px;"><a target="_blank" href="/SIG/{{$archivo->src_archivo}}{{$archivo->slug}}">/{{$archivo->src_archivo}}{{$archivo->slug}}</a></td>
             <td style="width: 100px">
              @if($user->tipo == 2)
              <button class= "btn m-btn--pill btn-outline-danger hola" data-toggle="modal" onclick="editarArchivo({{$archivo->id}})"nombreId = "{{$archivo->nombre}}"idArchivo="{{$archivo->id}}"><i class="la la-pencil-square"></i>Editar</button>
              
              <td style="width: 100px">
                <button class= "btn m-btn--pill btn-outline-danger" data-toggle="modal" onclick="eliminarArchivo({{$archivo->id}})"><i class="la la-trash"></i>Eliminar</button>
              </td>
              <td style="width: 100px" class="cambiar-archivo" moverArchivoId="{{$archivo->id}}">
                <button class= "btn m-btn--pill btn-outline-danger" data-toggle="modal" data-target="#m_modal_mover"><i class="la la-hand-paper-o"></i>Mover</button>
              </td>
              @endif
             </td>            
          </tr>
          <input type="hidden" id="temporal-nombre-archivo"> 
          <input type="hidden" id="temporal-id-archivo">  
          <input type="hidden" id="temporal-id-subcategoria"> 
          <input type="hidden" id="temporal-principal-subcategoria">
          <input type="hidden" id="temporal-principal-categoria"> 
          <input type="hidden" id="temporal-nombre-categoria"> 

          @endif
          
         @endforeach 
          </tbody>
        </table>
         </div>  
         <div class="m-portlet__body table-responsive"> 
            <table class="table table-striped- table-bordered table-hover table-checkable tabla_1" id="m_table_2">  
          <thead class="table-hover">
            <tr>
              <th colspan="2">Archivos Complementarios</th>
            </tr>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descargar</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($archivosYo as $archivo)
              @if($archivo->tipo == 2 && $archivo->n_subcategoria == $sub->nombre)

            <tr>
              <td>{{$archivo->id}}</td>
             <td>{{$archivo->slug}}</td>
             <td style="width: 350px;"><a target="_blank" href="/SIG/{{$archivo->src_archivo}}{{$archivo->slug}}">/{{$archivo->src_archivo}}{{$archivo->slug}}</a></td>
             
              @if($user->tipo == 2)
              <td style="width: 100px">
                <button class= "btn m-btn--pill btn-outline-danger hola" data-toggle="m_modal_1" onclick="editarArchivo({{$archivo->id}})"nombreId = "{{$archivo->nombre}}"><i class="la la-pencil-square"></i>Editar</button>
              </td>
              <td style="width: 100px">
                <button class= "btn m-btn--pill btn-outline-danger" data-toggle="modal" onclick="eliminarArchivo({{$archivo->id}})"><i class="la la-trash"></i>Eliminar</button>
              </td>
              <td style="width: 100px" class="cambiar-archivo" moverArchivoId="{{$archivo->id}}">
                <button class= "btn m-btn--pill btn-outline-danger" data-toggle="modal" data-target="#m_modal_mover"><i class="la la-hand-paper-o"></i>Mover</button>
              </td>              
             @endif
            </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
  @endforeach
 <div class=" row col-xl-12" >
    <div class="col-xl-4 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible  fade show" >
      <div class="m-dropdown " m-dropdown-toggle="hover">
        <a href="#" class=" btn " style="height: 78px" >
          <i class="flaticon-folder"></i>
          <span>Archivos Fuente</span>
        </a>
        <div class="m-dropdown__wrapper">   
          <div class="m-dropdown__inner" style="width: 400px;">
            <div class="m-dropdown__body">
              <div class="m-dropdown__content">
               <table >
                 <thead>
                    <tr>
                      <th style="width: 100px;">Descarga</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody> 
                    
                  @foreach($fuentes as $fuente)
                    <tr>
                
                  <td style="width: 500px;">
                     <a href="/SIG/{{$fuente->src_archivo}}{{$fuente->slug}}" class="btn btn-secondary btn-sm m-btn  m-btn m-btn--icon m-btn--pill">
                      <span>
                       <i class="fa flaticon-download"></i>
                        <span>{{$fuente->slug}}</span>
                      </span>
                   </a>
                  </td>
                  @if($user->tipo == 2)
                  <td style="width: 400px;">
                    <button class="btn btn-outline-danger m-btn btn-sm  m-btn--icon m-btn--pill"onclick="eliminarMover({{$fuente->id}})">
                      <span>
                        <i class="la la-trash"></i>
                        <span>Eliminar</span>
                      </button>
                    </a>
                  </td> 
                  @endif
                  </tr>
                 @endforeach
                  </tbody>
               </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <br>
    <div class="col-xl-4 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible  fade show" >
      <div class="m-dropdown " m-dropdown-toggle="hover">
        <a href="#" class=" btn " style="height: 78px" >
          <i class="flaticon-folder"></i>
          <span>Obsoletos</span>
        </a>
        <div class="m-dropdown__wrapper">   
          <div class="m-dropdown__inner"style="width: 400px;">
            <div class="m-dropdown__body">
              <div class="m-dropdown__content">
               <table>
                 <thead>
                    <tr>
                      <th style="width: 100px;">Descarga</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody> 
                    
                  @foreach($obsoletos as $obsoleto)
                    <tr>
                
                  <td style="width: 500px;">
                     <a href="/SIG/{{$obsoleto->src_archivo}}{{$obsoleto->slug}}" class="btn btn-secondary btn-sm m-btn  m-btn m-btn--icon m-btn--pill">
                      <span>
                       <i class="fa flaticon-download"></i>
                        <span>{{$obsoleto->slug}}</span>
                      </span>
                   </a>
                  </td>
                  <td style="width: 400px;">
                    <button class="btn btn-outline-danger m-btn btn-sm  m-btn--icon m-btn--pill"onclick="eliminarMover({{$obsoleto->id}})">
                      <span>
                        <i class="la la-trash"></i>
                        <span>Eliminar</span>
                      </button>
                    </a>
                  </td> 
                  </tr>
                 @endforeach
                  </tbody>
               </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="col-xl-4 m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible  fade show">
      <div class="m-dropdown " m-dropdown-toggle="hover">
        <a href="#" class=" btn " style="height: 78px" >
          <i class="flaticon-folder"></i>
          <span>Derogados</span>
        </a>
        <div class="m-dropdown__wrapper">   
          <div class="m-dropdown__inner"style="width: 400px;">
            <div class="m-dropdown__body">
              <div class="m-dropdown__content">
               <table>
                  <thead>
                    <tr>
                      <th style="width: 100px;">Descarga</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody> 
                    
                  @foreach($derogados as $derogado)
                    <tr>
                
                  <td style="width: 500px;">
                     <a href="/SIG/{{$derogado->src_archivo}}{{$derogado->slug}}" class="btn btn-secondary btn-sm m-btn  m-btn m-btn--icon m-btn--pill">
                      <span>
                       <i class="fa flaticon-download"></i>
                        <span>{{$derogado->slug}}</span>
                      </span>
                   </a>
                  </td>
                  <td style="width: 400px;">
                    <button class="btn btn-outline-danger m-btn btn-sm  m-btn--icon m-btn--pill"onclick="eliminarMover({{$derogado->id}})">
                      <span>
                        <i class="la la-trash"></i>
                        <span>Eliminar</span>
                      </button>
                    </a>
                  </td> 
                  </tr>
                 @endforeach
                  </tbody>
               </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
<!-- Agregar Subcategoria -->            
   <div class="modal fade" id="m_modal_agregar_subcategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="formulario-agregar-subcategoria">
          <div class="modal-header">
            <h5 class="modal-title">Subcategorias para: {{$categorias->nombre}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <label for="recipient-name" class="form-control-label">Agregar Subcategoria:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="" required>
            <input type="hidden" class="form-control" name="categoriaId" value="{{$categorias->id}}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<div class="modal fade" id="m_modal_mover" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form id="mover-archivo-usuario">
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
             <input type="hidden" name="id" id="archivo-mover">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="m_modal_editar_subcategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="formulario-editar-subcategoria">
          <div class="modal-body">
            <label for="recipient-name" class="form-control-label">Renombrar Subcategoria:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre-sub" required>
            <input type="hidden" class="form-control"name="id" id="principal-sub">
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="m_modal_editar_categoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="formulario-editar-categoria">
          <div class="modal-body">
            <label for="recipient-name" class="form-control-label">Renombrar Categoria:</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre-cat" required>
            <input type="hidden" class="form-control"name="id" id="principal-cat">
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form id="formulario-editar-archivo">
        <div class="modal-header">
          <h5 class="modal-title">Editar Archivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">  
          <div class="form-group m-form__group">
              <label>Nombre:</label>
              <input type="text" class="form-control m-input" name="nombre" id="nombre-archivo" data-required="true" required> 
              <input type="hidden" id="nombre-id" name="id"> 
          </div> 
             <label>Tipo:</label>
            <select class="form-control" name="tipo" id="editar-tipo">
            </select>
              <label>Categoria:</label>
            <select class="form-control" name="categoriaId"id="editar-categoria">
              <option class="form-control" value="0">Seleccione Categoria</option>  
            </select>
              <label>Subcategoria:</label>
            <select class="form-control" name="subcategoriaId"  id="editar-subcatego"></select>
               <label>Restricciones:</label>
            <select class="form-control" name="visible" id="editar-visible"></select> 
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
        <form id="registrar-archivo" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">Agregar nuevo Archivo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          <div class="modal-body">  
              <div class="form-group m-form__group">
                  <label>Nombre:</label>
                  <input type="text" class="form-control m-input" name="nombre" required> 
              </div> 
               <label>Tipo:</label>
              <select class="form-control" name="tipo" id="tipo-usuario">
                <option class="form-control" value="1">normal</option>
                <option class="form-control" value="2">Complementario</option>
              </select>
              <input type="hidden" name="subcategoriaId" id="subcategoria-id-form">
                 <label>Restricciones:</label>
              <select class="form-control" name="visible">
                <option class="form-control" value="1">Solo yo</option>
                <option class="form-control" value="2">Yo y usuarios con privilegios</option>
                 <option class="form-control" value="3">Yo, usuarios con privilegios, usuarios normales</option>
                <option class="form-control" value="4">Todos</option>
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
@endsection
  
@section("js")
  <script src="/SIG/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
  <script src="/SIG/js/usuario/datatables/archivo.js" type="text/javascript"></script>
  <script src="/SIG/js/usuario/agregarArchivo.js" type="text/javascript"></script>
  <script src="/SIG/js/usuario/agregarCategoria.js" type="text/javascript"></script>
  <script src="/SIG/js/usuario/agregarSubcategoria.js" type="text/javascript"></script> 
@endsection
