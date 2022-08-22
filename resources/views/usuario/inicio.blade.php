<!--
    dev: Claudia Altamira
    date 2019
-->
@extends("usuario.layout.main")

    @section("titulo")
    <title>SIG | Inicio</title>
    @endsection
        @section("contenido")
          <div class="m-content">
            <div class="row">
              <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <i class="flaticon-home "></i>&nbsp;&nbsp;
                        <h3 class="m-portlet__head-text">
                          BIENVENIDA 
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-scrollable" data-scrollable="true" style="height: 150px">
                      <p align="justify">{{$inicio->bienvenida}}</p> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <i class="flaticon-globe "></i>&nbsp;&nbsp;
                        <h3 class="m-portlet__head-text">
                          POLITICA
                        </h3>
                      </div>  
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-scrollable" data-scrollable="true" style="height: 150px">
                      <p>{{$inicio->politica}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <i class="flaticon-medal "></i>&nbsp;&nbsp;
                        <h3 class="m-portlet__head-text">
                          MISION
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-scrollable" data-scrollable="true" style="height: 200px">
                      <p>{{$inicio->mision}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <i class="flaticon-medical "></i>&nbsp;&nbsp;
                        <h3 class="m-portlet__head-text">
                          VISION 
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-scrollable" data-scrollable="true" style="height: 200px">
                      <p>{{$inicio->vision}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endsection
          @section("subtitulo")
            <h3 class="m-subheader__title m-subheader__title--separator">Inicio</h3>
          @endsection
       
    
