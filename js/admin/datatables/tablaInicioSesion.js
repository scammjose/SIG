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
                orderable: !1
                
            }]
        })
    }
};
jQuery(document).ready(function() {
    DatatablesBasicHeaders.init()
});