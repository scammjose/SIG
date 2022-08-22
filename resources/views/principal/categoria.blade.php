@extends("principal.layout.main")

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
    <div class="m-dropdown " m-dropdown-toggle="hover">
      
      <div class="m-dropdown__wrapper">   
        <div class="m-dropdown__inner">
          <div class="m-dropdown__body">
            <div class="m-dropdown__content">
              <ul class="m-nav">
           
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="m-alert__text"><h2>{{$categorias->nombre}}</h2></div>
    <div class="m-alert__actions" style="width: 220px;">
    </div>
  </div>
  <!-- categoria -->
  @foreach($subcategoria as $sub)
  
    <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head m-alert--outline alert-success" >
        <div class="m-dropdown " m-dropdown-toggle="hover">
          
          <div class="m-dropdown__wrapper">   
            <div class="m-dropdown__inner">
              <div class="m-dropdown__body">
                <div class="m-dropdown__content">
                  <ul class="m-nav">
                    
                    <br>
                    <li class="m-nav__item">
                      
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

      
              <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                  <h3 class="m-portlet__head-text">{{$sub->nombre}}</h3>
                </div>
              </div>
      

        <div class="m-portlet__head-tools">
          <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
              
            </li>
            <li class="m-portlet__nav-item"></li>
          </ul>
        </div>
      </div>
      <div class="m-portlet__body"> 
            <table class="table table-striped- table-bordered table-hover table-checkable tabla_1" id="m_table_1">  
          <thead>
            <tr>
              <th colspan="2">Archivos Normales</th>
            </tr>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descargar</th>
              
            </tr>  
          </thead>
          <tbody>
         @foreach($archivos as $archivo)
          @if($archivo->tipo == 1 && $archivo->n_subcategoria == $sub->nombre)
          <tr>
            <td>{{$archivo->id}}</td>
             <td>{{$archivo->slug}}</td>
             <td><a target="_blank" href="/SIG/{{$archivo->src_archivo}}{{$archivo->slug}}">/{{$archivo->src_archivo}}{{$archivo->slug}}</a></td>
             
          </tr>
          @endif
         @endforeach 
          </tbody>
        </table>
         </div>  
         <div class="m-portlet__body"> 
            <table class="table table-striped- table-bordered table-hover table-checkable tabla_1" id="m_table_2">  
          <thead>
            <tr>
              <th colspan="2">Archivos Complementarios</th>
            </tr>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descargar</th>
            </tr>
          </thead>
          <tbody>
            @foreach($archivos as $archivo)
              @if($archivo->tipo == 2 && $archivo->n_subcategoria == $sub->nombre)
            <tr>
              <td>{{$archivo->id}}</td>
             <td>{{$archivo->slug}}</td>
             
            </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
  @endforeach
</div> 

@endsection
  
@section("js")
   <script src="/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/js/principal/datatables/tablaCategorias.js" type="text/javascript"></script>
@endsection

