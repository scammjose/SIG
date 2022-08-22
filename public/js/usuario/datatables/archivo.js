var DatatablesBasicHeaders = {
    init: function() {
    
        $(".tabla1").DataTable({
            responsive: !0,
            pagingType: "full_numbers"     
        }) 
      
       
        // $("#m_table_"+i).DataTable({
        //     responsive: !0,
        //     pagingType: "full_numbers"     
        // })
    }
};
jQuery(document).ready(function() {
    DatatablesBasicHeaders.init()
});
 