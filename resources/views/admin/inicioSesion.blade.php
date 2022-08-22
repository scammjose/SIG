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
                      Inicios de sesion
                    </h3>
                  </div>
                </div>
               </div>
              <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Fecha y hora de inicio de sesion</th>
                    </tr>
                  </thead>
                  <tbody>
                 @foreach($sesiones as $sesion)
                    <tr>
                      
                      <td>{{$sesion->id}}</td>
                      <td>{{$sesion->usuarios->nombre}}</td>
                      <td>{{$sesion->usuarios->apellidoPaterno}}</td>
                      <td>{{$sesion->usuarios->apellidoMaterno}}</td>
                      <td>{{$sesion->created_at}}</td>
                     
                    </tr>
                     @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>


           @endsection

           @section("subtitulo")
           <h3 class="m-subheader__title m-subheader__title--separator">Inicios de Sesion</h3>
           @endsection
       
       
    @section("js")
       <script src="/SIG/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/SIG/js/admin/datatables/tablaInicioSesion.js" type="text/javascript"></script>
    @endsection
