<!--
    dev: Claudia Altamira
    date 2019
-->
@extends("usuario.layout.main")

    @section("titulo")
    <title>SIG | Usuario</title>
    @endsection
 
          @section("contenido")
            

<div class="row">
 
  <div class="col-md-6">
   

        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                  <div class="m-portlet__head m-portlet__head--fit">
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-widget19">
                      <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                        <img src="/SIG/images/sig.png" alt="">
                        <h3 class="m-widget19__title m--font-light">
                        
                        </h3>
                        <div class="m-widget19__shadow"></div>
                      </div>
                      <div class="m-widget19__content">
                        <div class="m-widget19__header">
                          
                          <div class="m-widget19__info">
                             <h3>
                        BIENVENIDO A SIG UPT 
                        </h3>
                          </div>
                          <div class="m-widget19__stats">
                            
                            <span class="m-widget19__comment">
                              
                            </span>
                          </div>
                        </div>
                        <div class="m-widget19__body">
                         {{$inicio->bienvenida}}
                        </div>
                      </div>
                      <div class="m-widget19__action">
                        
                      </div>
                    </div>
                  </div>
                </div>
                 </div>
                <div class="col-md-6">
                  <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                  <div class="m-portlet__head m-portlet__head--fit">
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-widget19">
                      <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                        <img src="/SIG/images/escoltaUpt.jpg" alt="">
                        <h3 class="m-widget19__title m--font-light">
                        
                        </h3>
                        <div class="m-widget19__shadow"></div>
                      </div>
                      <div class="m-widget19__content">
                        <div class="m-widget19__header">
                          
                          <div class="m-widget19__info">
                             <h3>
                        POLITICA    
                        </h3>
                          </div>
                          <div class="m-widget19__stats">
                            <span class="m-widget19__number m--font-brand">
                              <i class="flaticon-globe"></i>
                            </span>
                            <span class="m-widget19__comment">
                              
                            </span>
                          </div>
                        </div>
                        <div class="m-widget19__body">
                         {{$inicio->politica}}
                        </div>
                      </div><br><br>
                      <div class="m-widget19__action" >
                       
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              
                </div>

<div class="row">
 
  <div class="col-md-6">
   

        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                  <div class="m-portlet__head m-portlet__head--fit">
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-widget19">
                      <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                        <img src="/SIG/images/pinturaUpt.jpg" alt="">
                        <h3 class="m-widget19__title m--font-light">
                        
                        </h3>
                        <div class="m-widget19__shadow"></div>
                      </div>
                      <div class="m-widget19__content">
                        <div class="m-widget19__header">
                          
                          <div class="m-widget19__info">
                             <h3>
                            MISION
                            </h3>
                          </div>
                          <div class="m-widget19__stats">
                            <span class="m-widget19__number m--font-brand">
                              2020
                            </span>
                            <span class="m-widget19__comment">
                              
                            </span>
                          </div>
                        </div>
                        <div class="m-widget19__body">
                         {{$inicio->mision}}
                        </div>
                      </div>
                      <div class="m-widget19__action">
                        
                      </div>
                    </div>
                  </div>
                </div>
                 </div>
                <div class="col-md-6">
                  <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                  <div class="m-portlet__head m-portlet__head--fit">
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-widget19">
                      <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                        <img src="/SIG/images/visionUpt.jpg" alt="">
                        <h3 class="m-widget19__title m--font-light">
                        
                        </h3>
                        <div class="m-widget19__shadow"></div>
                      </div>
                      <div class="m-widget19__content">
                        <div class="m-widget19__header">
                          
                          <div class="m-widget19__info">
                             <h3>
                        VISION    
                        </h3>
                          </div>
                          <div class="m-widget19__stats">
                            <span class="m-widget19__number m--font-brand">
                              <i class="flaticon-globe"></i>
                            </span>
                            <span class="m-widget19__comment">
                              
                            </span>
                          </div>
                        </div>
                        <div class="m-widget19__body">
                         {{$inicio->vision}}
                        </div>
                      </div>
                      <div class="m-widget19__action" >
                       
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              
                </div>
           @endsection

           @section("subtitulo")
           <h3 class="m-subheader__title m-subheader__title--separator">Dashboard</h3>
           @endsection
       
    @section("js")
   
    @endsection
