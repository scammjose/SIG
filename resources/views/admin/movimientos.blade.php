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
                      Movimiento de Usuarios
                    </h3>
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

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tipo de Movimiento</th>
                      <th>Informe</th>
                      
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($movimiento as $movimientos)
                    <tr>      
                      <td>{{$movimientos->id}}</td>
                      <td>{{$movimientos->movimiento}}</td>
                      <td>{{$movimientos->informe}}</td>
                      <td>{{$movimientos->created_at}}</td>   
                    </tr>
                 @endforeach
                  </tbody>
                </table>
              </div>
            </div>
           @endsection

           @section("subtitulo")
           <h3 class="m-subheader__title m-subheader__title--separator">Movimientos de Usuario</h3>
           @endsection
       
    @section("js")
       <script src="/SIG/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/SIG/js/admin/datatables/tablaMovimientos.js" type="text/javascript"></script>
    @endsection
 