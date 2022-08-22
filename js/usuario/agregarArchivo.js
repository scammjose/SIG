/*
    dev: Oscar Peralta
    date 2019
*/
$(".sub-id").click(function() { 
var idExtra = $(this).attr("idSub");

// $("#temporal-id-subcategoria").val(idExtra);
// var id = $("#temporal-id-subcategoria").val();
$("#subcategoria-id-form").val(idExtra);

});
$(".hola").click(function() { 
var idExtraido = $(this).attr("nombreId");

 $("#temporal-nombre-archivo").val(idExtraido);

});
$(".cambiar-archivo").click(function(){
             var archivoId = $(this).attr("moverArchivoId");
          
              $("#archivo-mover").val(archivoId);
        });
$('#mover-archivo-usuario').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#mover-archivo-usuario').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/usuario/movimiento-archivo",
        data: formData,
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (data.estado == true) {
                swal({
                    title: '<i>¡Genial!</i>',
                    type: 'success',
                    html:'<b>'+data.mensaje+'</b>. ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i>Aceptar',
                    confirmButtonAriaLabel: 'Aceptar!',
                }).then(function(){
                    location.reload();
                });
            }else{
                swal("Ocurrio un problema", data.detalle, "error");
                return false;
            }
        }
    });
});

function editarArchivo(idArc){

     var actual = window.location+'';
     var split = actual.split("/");     //Se obtiene el ultimo valor de la URL
     var id = split[split.length-1];
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/SIG/usuario/categoria/"+id+"/verificar-archivo/"+idArc,
        type: "get",
        dataType: "json",
        cache: false,
        error: function(element){}, 
          success: function(data){
               var name = data.archivos;
               console.log(name[0].id);
               $('#nombre-archivo').val(name[0].nombre);
                if (name[0].tipo == 1) {
                  var html = "";
                  html += '<option class="form-control" value="1" selected>normal</option>'+'<option class="form-control" value="2">Complementarios</option>';
                  $('#editar-tipo').html(html);
                }
                if (name[0].tipo == 2) {
                  var html1 = "";
                  html1 += '<option class="form-control" value="1">normal</option>'+'<option class="form-control" value="2" selected>Complementarios</option>';
                  $('#editar-tipo').html(html1);
                }
                if (name[0].visible == 1) {
                  var html2 = "";
                  html2 = '<option class="form-control" value="1" selected>Solo yo</option>'+'<option class="form-control" value="2">Yo y usuarios con privilegios</option>'+'<option class="form-control" value="3">Yo, Usuario con privilegios, usuarios normales</option>'+'<option class="form-control" value="4">Todos</option>';
                    $('#editar-visible').html(html2);                                     
                }     
                if (name[0].visible == 2) {
                  var html3 = "";
                  html3 += '<option class="form-control" value="1">Solo yo</option>'+'<option class="form-control" value="2" selected>Yo y usuarios con privilegios</option>'+'<option class="form-control" value="3">Yo, Usuario con privilegios, usuarios normales</option>'+'<option class="form-control" value="4">Todos</option>';
                    $('#editar-visible').html(html3);                                 
                }  
                if (name[0].visible == 3) {
                  var html4 = "";
                  html4 += '<option class="form-control" value="1">Solo yo</option>'+'<option class="form-control" value="2">Yo y usuarios con privilegios</option>'+'<option class="form-control" value="3" selected>Yo, Usuario con privilegios, usuarios normales</option>'+'<option class="form-control" value="4">Todos</option>';
                    $('#editar-visible').html(html4);                                    
                  } 
                  if (name[0].visible == 4) {
                  var html6 = "";
                  html6 += '<option class="form-control" value="1">Solo yo</option>'+'<option class="form-control" value="2">Yo y usuarios con privilegios</option>'+'<option class="form-control" value="3">Yo, Usuario con privilegios, usuarios normales</option>'+'<option class="form-control" value="4" selected>Todos</option>';
                    $('#editar-visible').html(html6);                                    
                  } 
                  var category = data.categoria; 
                   $('#nombre-id').html('<input type="hidden" value="'+name[0].id+'" name="id">' ); 
                for (var i = 0; i < category.length; i++) {
                  if (category[i].id == name[0].categoriaId) {
                    var html5 = "";
                    html5 += '<option class="form-control" onclick="editarSub('+category[i].id+')" value="'+category[i].id+'" selected>'+category[i].nombre+'</option>';
                  $('#editar-categoria').html(html5);                                    

                  }else{
                    html5 += '<option class="form-control" onclick="editarSub('+category[i].id+')" value="'+category[i].id+'">'+category[i].nombre+'</option>';
                    $('#editar-categoria').html(html5);                                    

                  }
                }
               
              $('#m_modal_1').modal('show');        
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/SIG/usuario/categoria/"+id+"/subcategoria-id/"+name[0].n_subcategoria,
            type: "GET",
            dataType: "json",
            cache: false,
            error: function(element){}, 
            success: function(data1){
                var subId =  data1.sub;
                var subCompletas = data.subcatego;
                var este = '<option value="'+subId.id+'"selected>'+name[0].n_subcategoria+'</option>'; 
                   for (var i = 0; i < subCompletas.length; i++) {
                    este += '<option value="'+subCompletas[i].id+'">'+subCompletas[i].nombre+'</option>';
                    console.log(este);
                      $('#editar-subcatego').html(este);
                   }
            }    
            })
          }    
        })

}

 $('#formulario-editar-archivo').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#formulario-editar-archivo').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/usuario/editar-archivo",
        data: formData,
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (data.estado == true) {
                swal({
                    title: '<i>¡Genial!</i>',
                    type: 'success',
                    html:'<b>'+data.mensaje+'</b>. ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i>Aceptar',
                    confirmButtonAriaLabel: 'Aceptar!',
                }).then(function(){
                    location.reload();
                });
            }else{
                swal("Ocurrio un problema", data.detalle, "error");
                return false;
            }
        }
    });
});
function eliminarArchivo(id){  
   swal({
      title: 'Desea eliminar este Archivo?',
      text: "No podra recuperarlo posteriormente", 
      showCancelButton: true,
      type: 'warning',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar',
      showLoaderOnConfirm: true,
      preConfirm: function () {
        return new Promise(function (resolve, reject) {
                       $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "get",
              url: "/SIG/usuario/eliminar-archivo/"+id,
              dataType: 'json',
              cache: false,
              success: function (data) {
                  if (data.estado == true) {
                      swal({
                         title:  'Operacion Correcta!',
                          text: 'El archivo ha sido eliminado.',
                          type: 'success',
                      }).then(function(){
                          location.reload();
                      });
                  }else{
                      swal("Ocurrio un problema", data.detalle, "error");
                      return false;
                 }
              }
          })
        })
      },
      allowOutsideClick: false
    }).then(function (response) {
        swal({
          title: 'Operacion Cancelada',
          type: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Cerrar!',
          allowOutsideClick: false
        })
    })
}
// editarSubcategoria

$('.sub-editar').click(function(){
    var subcategoria = $(this).attr('subId'); 
    var subcategoriaNombre = $(this).attr('idNombre');
    

      // $("#temporal-principal-subcategoria").val(subcategoria);
     //  var nombreId= $("#temporal-principal-subcategoria").val();
     
     $('#principal-sub').val(subcategoria);

    $('#nombre-sub').val(subcategoriaNombre);

    
    $('#m_modal_editar_subcategoria').modal('show');
});

$('.cat-editar').click(function(){
    var categoria = $(this).attr('idCat'); 
    var nombre = $(this).attr('nomCat');
     $('#nombre-cat').val(nombre);
     $('#principal-cat').val(categoria);

    
    $('#m_modal_editar_categoria').modal('show');
});
$('#formulario-editar-categoria').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#formulario-editar-categoria').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/usuario/edicion-categoria",
        data: formData,
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (data.estado == true) {
                swal({
                    title: '<i>¡Genial!</i>',
                    type: 'success',
                    html:'<b>'+data.mensaje+'</b>. ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i>Aceptar',
                    confirmButtonAriaLabel: 'Aceptar!',
                }).then(function(){
                    location.reload(true);
                });
            }else{
                swal("Ocurrio un problema", data.detalle, "error");
                return false;
            }
        }
    });
});
 $('#formulario-editar-subcategoria').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#formulario-editar-subcategoria').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/usuario/edicion-subcategoria",
        data: formData,
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (data.estado == true) {
                swal({
                    title: '<i>¡Genial!</i>',
                    type: 'success',
                    html:'<b>'+data.mensaje+'</b>. ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i>Aceptar',
                    confirmButtonAriaLabel: 'Aceptar!',
                }).then(function(){
                    location.reload(true);
                });
            }else{
                swal("Ocurrio un problema", data.detalle, "error");
                return false;
            }
        }
    });
});

function editarSub(id_cat){

     var actual = window.location+'';
     //Se realiza la división de la URL
     var split = actual.split("/");
     //Se obtiene el ultimo valor de la URL
     var id = split[split.length-1];

    if (id_cat == 0){

        $('#editar-subcatego').html('<option value="0">Seleccione Subcategoria</option>');
      
         }else{
          $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/SIG/"+id+"/nivel/"+id_cat,
        type: "get",
        dataType: "json",
        cache: false,
        error: function(element){}, 
          success: function(data){
            var html_levels = '<option value="">Seleccione Subcategoria</option>';
               for (var i = 0; i < data.length; i++) {
                html_levels += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                    $('#editar-subcatego').html(html_levels);
               }
          }    
        })
       }  
 }
 $('#registrar-archivo').on('submit', function (e)
    {

         e.preventDefault();
         
            var file = $("#entrada-archivo")[0].files[0];
            var fileName = file.name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            var fileSize = file.size;
            var fileType = file.type;
            
        var formData = new FormData($('#registrar-archivo')[0]);
        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/SIG/usuario/agregar-archivo",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                //mientras enviamos el archivo
                beforeSend: function(){
                    swal({   title: "¡Cargando el archivo!",
                        text: "Por favor, espera a que termine de cargar el archivo",
                        imageUrl: "/SIG/images/cargando.gif",
                        showConfirmButton: false
                    });
                },
                //una vez finalizado correctamente
                success: function(data){
                    if (data.estado == true) {
                swal({
                    title: '<i>¡Genial!</i>',
                    type: 'success',
                    html:'<b>'+data.mensaje+'</b>. ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i>Aceptar',
                    confirmButtonAriaLabel: 'Aceptar!',
                }).then(function(){
                    location.reload(true);
                });
            }else{
                swal("Ocurrio un problema", data.detalle, "error");
                return false;
            }
        }
    });
  });
function eliminarMover(id){
   swal({
      title: 'Desea eliminar este Archivo en Archivos Fuente?',
      text: "No se podran recuperar", 
      showCancelButton: true,
      type: 'warning',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar',
      showLoaderOnConfirm: true,
      preConfirm: function () {
        return new Promise(function (resolve, reject) {
                       $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "get",
              url: "/SIG/usuario/eliminar-mover/"+id,
              dataType: 'json',
              cache: false,
              success: function (data) {
                  if (data.estado == true) {
                      swal({
                         title:  'Operacion Correcta!',
                          text: 'El archivo ha sido eliminado.',
                          type: 'success',
                      }).then(function(){
                          location.reload();
                      });
                  }else{
                      swal("Ocurrio un problema", data.detalle, "error");
                      return false;
                 }
              }
          })
        })
      },
      allowOutsideClick: false
    }).then(function (response) {
        swal({
          title: 'Operacion Cancelada',
          type: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Cerrar!',
          allowOutsideClick: false
        })
    })
}
function eliminarSubcate(id,idCat){
 
   swal({
      title: 'Desea eliminar esta Subcategoria?',
      text: "Se eliminaran los archivos que contenga", 
      showCancelButton: true,
      type: 'warning',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar',
      showLoaderOnConfirm: true,
      preConfirm: function () {
        return new Promise(function (resolve, reject) {
                       $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "get",
              url: "/SIG/usuario/eliminar-subcategoria/"+id+"/"+idCat,
              dataType: 'json',
              cache: false,
              success: function (data) {
                  if (data.estado == true) {
                      swal({
                         title:  'Operacion Correcta!',
                          text: 'La subcategoria ha sido eliminada.',
                          type: 'success',
                      }).then(function(){
                          location.reload();
                      });
                  }else{
                      swal("Ocurrio un problema", data.detalle, "error");
                      return false;
                 }
              }
          })
        })
      },
      allowOutsideClick: false
    }).then(function (response) {
        swal({
          title: 'Operacion Cancelada',
          type: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Cerrar!',
          allowOutsideClick: false
        })
    })
}







   