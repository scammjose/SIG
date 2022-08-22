/*
    dev: Oscar Peralta
    date 2019
*/
$('#formulario-agregar-categoria').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#formulario-agregar-categoria').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/SIG/admin/agregar-categoria",
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

function editarCategoria() {

    var id = $("#id").val();
    var nombre = $("#nombre").val();
    $("#id").val(id);
    $("#nombre-categoria").val(nombre);
    $("#m_modal_editar_categoria").modal('show');
}

function eliminarCatego(id) {

   
   swal({
      title: 'Desea eliminar esta Categoria?',
      text: "No podra recuperar los archivos ni las subcategorias", 
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
              url: "/SIG/admin/eliminar-categoria/"+id,
              dataType: 'json',
              cache: false,
              success: function (data) {
                  if (data.estado == true) {
                      swal({
                         title:  'Operacion Correcta!',
                          text: 'La categoria ha sido eliminada.',
                          type: 'success',
                      }).then(function(){
                          location.href= "/SIG/admin/inicio/";
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

function eliminarMover(id){
   swal({
      title: 'Desea eliminar este Archivo?',
      text: "No se podra recuperar", 
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
              url: "/SIG/admin/eliminar-mover/"+id,
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