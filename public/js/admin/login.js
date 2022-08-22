/*
    dev: Oscar Peralta
    date 2019
*/
$(document).ready(function(){
    $('#form-login-admin').on('submit', function (e) {
        e.preventDefault();
        var formData = $('#form-login-admin').serialize();
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
             
                    location.href = "/dashboard";
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
