/*
    dev: Claudia Altamira
    date 2019
*/
$(document).ready(function(){
    $('#form-login-usuario').on('submit', function (e) {
        e.preventDefault();
        var formData = $('#form-login-usuario').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/login",
            data: formData,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.estado == true) {    
                    if (data.estatus == 1 ) {
                        console.log(data.estado);

                        location.href = "/usuario/dashboard/";
                    }else{
                        location.href = "/usuario/primerInicio/";
                    }
                }else if(data.detalle == "incorrecto"){
                    swal("Datos incorrectos", "verifica la información", "error");
                }else{
                    swal("Ocurrio un problema", data.mensaje, "error");
                    return false;
                }
            }
        });
    });
});
