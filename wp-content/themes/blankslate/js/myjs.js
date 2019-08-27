 jQuery(function ($) {
     
        
        $(".employee_element").click(function() {
                var element = $(this).next();
            $(element).fadeIn(300);
        });
        
        $(".close_x").click(function() {
            $(this).parent().parent().fadeOut(300);
        });
     
        
});


