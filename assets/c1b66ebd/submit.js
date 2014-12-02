$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });
                var fokus = false;
                $("input").each(function(){
                    if(!fokus){
                        $(this).focus()
                    }
                    else{
                        fokus = false;
                    }

                });
            }
        });
    });
});