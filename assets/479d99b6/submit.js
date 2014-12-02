$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });
                var focused = false;
                $('input', 'textarea').each(function(i, er){
                    if(focused == true){
                        focused = false;
                        $(er).focus();
                    }
                    if($(er).is( ":focus" )){
                        focused = true;
                        $(er).blur();
                    }
                });
            }
        });
    });
});