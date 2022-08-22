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
                title: "Editar/Eliminar",
                orderable: !1,
                render: function(a, e, t, n) {
                    return '\n<span class="dropdown">\n<a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n  <i class="la la-ellipsis-h"></i>\n</a>\n<div class="dropdown-menu dropdown-menu-right">\n<a class="dropdown-item" onclick="edicionArchivo()" id = "boton" href="#"><i class="la la-edit"></i>Editar Archivo</a>\n<a class="dropdown-item" onclick="eliminarArchivo()" id = "" href="#"><i class="la la-trash"></i> Eliminar Archivo</a>\n</div>\n</span>\n'
                }
            }, {
                targets: 2,
                render: function(a, e, t, n) {
                    var s = {
                        1: {
                            title: "normal",
                            state: "accent"
                        },
                        2: {
                            title: "Complementario",
                            state: "success"
                        }
                        
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge m-badge--' + s[a].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + s[a].state + '">' + s[a].title + "</span>"
                }
            }, {
                targets: 4,
                render: function(a, e, t, n) {
                    var s = {
                        1: {
                            title: "Solo yo",
                            state: "accent"
                        },
                        2: {
                            title: "Yo y usuarios con Privilegios",
                            state: "success"
                        },
                        3: {
                            title: "Yo, usuarios con Privilegios y usuarios Normales",
                            state: "accent"
                        },
                        4: {
                            title: "Todos",
                            state: "sucess"
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
 
 $(".archivo").click(function() { 
  
    var editarNombre = $(this).attr("nombre");
    var editarTipo = $(this).attr("tipo");
    var editarCategoria = $(this).attr("categoria");
    var editarVisible = $(this).attr("visible");
    var editarId = $(this).attr("idEditar");

     $("#temporal-editar-nombre").val(editarNombre);
     $("#temporal-editar-tipo").val(editarTipo);
     $("#temporal-editar-categoria").val(editarCategoria);
     $("#temporal-editar-visible").val(editarVisible);
     $("#temporal-editar-id").val(editarId);
    

 if (editarCategoria == 0){
        // $('#editar-subcategoria').html('<option value="">Seleccione Subcategoria</option>');
        return;
         }
          $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "niveles/"+editarCategoria,
        type: "GET",
        dataType: "json",
        cache: false,
        error: function(element){}, 
          success: function(data){
            var html_levels = '<option value="">Seleccione Subcategoria</option>';
               for (var i = 0; i < data.length; i++) {
                html_levels += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                    $('#editar-subcategoria').html(html_levels);
               }
          }    
        })

});

function eliminarArchivo(){
  $(".archivo").click(function() { 
    var id = $(this).attr("eliminar");
    swal({
   title: "ADVERTENCIA:", 
   text: "Eliminara el archivo dentro de esta categoria", 
   type: "warning",
   inputType: "submit",
   showCancelButton: true,
   closeOnConfirm: true
   
       }).then(function () {
  // código que elimina
  $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "get",
        url: "/admin/eliminar-archivo/"+id,
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
    });
});
     });
}
 function edicionArchivo(){
    
    var nombreId= $("#temporal-editar-id").val();
    var nombreArchivo = $("#temporal-editar-nombre").val();
    var nombreTipo= $("#temporal-editar-tipo").val();
    var nombreCategoria= $("#temporal-editar-categoria").val();
    var nombreVisible= $("#temporal-editar-visible").val();
    
    $("#nombre-archivo").val(nombreArchivo);
    $("#editar-tipo").val(nombreTipo);
    $("#editar-categoria").val(nombreCategoria);
    $("#editar-visible").val(nombreVisible);
    $("#nombre-id").val(nombreId);
    
    $("#m_modal_3").modal('show');
 }

 function editarSub(id){

    
    if (id == 0){
        $('#editar-subcategoria').html('<option value="">Seleccione Subcategoria</option>');
      
         }else{
          $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "niveles/"+id,
        type: "GET",
        dataType: "json",
        cache: false,
        error: function(element){}, 
          success: function(data){
            var html_levels = '<option value="">Seleccione Subcategoria</option>';
               for (var i = 0; i < data.length; i++) {
                html_levels += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                    $('#editar-subcategoria').html(html_levels);
               }
          }    
        })
       }  
 }




