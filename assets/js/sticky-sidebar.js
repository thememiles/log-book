jQuery(document).ready(function($){

     "use strict"

//sticky sidebar
    var at_body = $("body");
    var at_window = $(window);

   if(at_body.hasClass('sb-sticky-sidebar'))
   {

            if(at_body.hasClass('has-sidebar')){
                                
                $('#secondary, #primary').theiaStickySidebar();
            }
            else{
                $('#secondary, #primary').theiaStickySidebar();
            }
    }



      

})//end Ready



