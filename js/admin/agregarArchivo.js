/*
    dev: Oscar Peralta
    date 2019
*/
$(function(){
$('#select-categoria').on('change', selectLevels);
});

function selectLevels(){
	
	  var id_category = $(this).val();
    	 
         if (id_category == 0){
        $('#select-subcategoria').html('<option value="">Seleccione Subcategoria</option>');
        return;
         }
	      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/SIG/niveles/"+id_category,
        type: "GET",
        dataType: "json",
        cache: false,
        error: function(element){}, 
          success: function(data){
            if (data.estado == false) {
                swal({
                    title: '<i>¡Ups!</i>',
                    type: 'warning',
                    html:'<b>'+data.detalle+'</b>. ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: 'Aceptar',
                    confirmButtonAriaLabel: 'Aceptar!',
                });
            }else{
                var html_levels = '<option value="">Seleccione Subcategoria</option>';
               for (var i = 0; i < data.length; i++) {
                html_levels += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                    $('#select-subcategoria').html(html_levels);
               }
            }
       		
          }    
        })
      
}
$(document).ready(function(){
        $(".cambiarArchivo").click(function(){
             var archivoId = $(this).attr("idArchivo");
              $("#archivo-nuevo-id").val(archivoId);
        });

});

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
                url: "/SIG/admin/agregar-archivo/registro",
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
 $('#mover-archivo').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#mover-archivo').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/admin/mover-archivo",
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
 $('#editar-archivo').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#editar-archivo').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/admin/editar-archivo",
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
