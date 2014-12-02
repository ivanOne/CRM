$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });
                var focused = false;
                $('input', 'textarea').each(function(i, e){
                    if(focused == true){
                        focused = false;
                        $(e).focus();
                    }
                    if($(e).is( ":focus" )){
                        focused = true;
                        $(e).blur();
                    }
                });
            }
        });
    });
});