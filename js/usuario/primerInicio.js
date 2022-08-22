/*
    dev: Claudia Altamira
    date 2019
*/
$(document).ready(function(){

    $('#password-1').focus(); 
    $('#form-primer-inicio').on('submit', function (e) {
        var contra1 = $('#password-1').val();
        var contra2 = $('#password-2').val();
        e.preventDefault();
        if (contra1.length < 4 || contra2.length < 4) {
            sweetAlert("Error", " La contraseña debe tener mas de 5 caracteres ","error");
            return false;
        }
        if (contra1 != contra2) {
            sweetAlert("Error","Las contraseñas no coinciden","error");
            return false;
        }
        var formData = $('#form-primer-inicio').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/SIG/usuario/primer-inicio",
            data: formData,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (data.estado == true) {
                    location.href = '/SIG/usuario/dashboard';
                }else{
                    swal("Ocurrio un problema", data.detalle, "error");
                    return false;
                }
            }
        });
    });
});
