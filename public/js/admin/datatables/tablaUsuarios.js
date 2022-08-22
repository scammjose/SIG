/*
    dev: Oscar Peralta
    date 2019
*/
var DatatablesBasicHeaders = {
    init: function() {
        $("#m_table_1").DataTable({
            responsive: !0,
            columnDefs: [{
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(a, e, t, n) {
                    return '\n<span class="dropdown">\n<a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n  <i class="la la-ellipsis-h"></i>\n</a>\n<div class="dropdown-menu dropdown-menu-right">\n<a class="dropdown-item" onclick="editarUsuario()" id = "boton" href="#"><i class="la la-edit"></i>Editar Usuario</a>\n<a class="dropdown-item" onclick="eliminarUsuario()" id = "" href="#"><i class="la la-trash"></i> Eliminar Usuario</a>\n</div>\n</span>\n'
                }
            }, {
                targets: 5,
                render: function(a, e, t, n) {
                    var s = {
                        1: {
                            title: "normal",
                            state: "accent"
                        },
                        2: {
                            title: "Con privilegios",
                            state: "success"
                        }
                        
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge m-badge--' + s[a].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + s[a].state + '">' + s[a].title + "</span>"
                }
            }]
        })
    }
};
jQuery(document).ready(function() {
    DatatablesBasicHeaders.init()
});
 
$(".usuario").click(function() { 
  


    var usuarioId = $(this).attr("usuarioId");
    var usuarioEliminar = $(this).attr("usuarioEliminar");
    var usuarioNombre = $(this).attr("usuarioNombre");
    var usuarioAp = $(this).attr("usuarioAp");
    var usuarioAm = $(this).attr("usuarioAm");
    var usuarioCorreo = $(this).attr("usuarioCorreo");
    var usuarioTipo = $(this).attr("usuarioTipo");
    var usuarioCodigo = $(this).attr("usuarioCodigo");
    var usuarioPassword = $(this).attr("usuarioPassword");


    $("#temporal-usuario-id").val(usuarioId);
    $("#temporal-usuario-eliminar").val(usuarioId);
    $("#temporal-usuario-nombre").val(usuarioNombre);
    $("#temporal-usuario-ap").val(usuarioAp);
    $("#temporal-usuario-am").val(usuarioAm);
    $("#temporal-usuario-codigo").val(usuarioCodigo);  
    $("#temporal-usuario-correo").val(usuarioCorreo);
    $("#temporal-usuario-password").val(usuarioPassword);
    $("#temporal-usuario-tipo").val(usuarioTipo);


});

function editarUsuario() {


     var id = $("#temporal-usuario-id").val();
    var nombre = $("#temporal-usuario-nombre").val();
    var ap = $("#temporal-usuario-ap").val();
    var am = $("#temporal-usuario-am").val();
    var password = $('#temporal-usuario-password').val(); 
    var correo = $('#temporal-usuario-correo').val();
    var tipo= $("#temporal-usuario-tipo").val();
    var codigo = $("#temporal-usuario-codigo");

     $("#id-usuario").val(id);
     $("#nombre-usuario").val(nombre);
     $("#ap-usuario").val(ap);
     $("#am-usuario").val(am);
     $("#password-usuario").val(password);
     $("#correo-usuario").val(correo);
     $("#tipo-usuario").val(tipo);
     $("#codigo-usuario").val(codigo);


   
    $("#m_modal_2").modal('show');

}
function eliminarUsuario() {


     var idEliminar = $("#temporal-usuario-eliminar").val();
     $("#usuario-eliminar").val(idEliminar);


   
    $("#m_modal_3").modal('show');

}

function resetarCuenta(id,nombre,ap,am,correo,tipo,codigo){
    $("#usuario-id-reset").val(id);
     $("#usuario-nombre-reset").val(nombre);
     $("#usuario-ap-reset").val(ap);
     $("#usuario-am-reset").val(am);
     $("#usuario-correo-reset").val(correo);
     $("#usuario-tipo-reset").val(tipo);
     $("#usuario-codigo-reset").val(codigo);
}