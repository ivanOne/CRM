$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            var er = jQuery.Event("keydown", { keyCode: 9 });
                            jQuery("form").trigger(er);
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });

            }
        });
    });
});