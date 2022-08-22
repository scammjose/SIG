/*
    dev: Oscar Peralta
    date 2019
*/
$('#formulario-agregar-subcategoria').on('submit', function (e) {
    e.preventDefault();
    var formData = $('#formulario-agregar-subcategoria').serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/usuario/agregar-subcategoria",
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

// function editarSubcategoria() {

//     var id = $("#id").val();
//     var nombre = $("#nombre").val();
//     $("#id").val(id);
//     $("#nombre-subcategoria").val(nombre);
//     $("#m_modal_editar_subcategoria").modal('show');
// }