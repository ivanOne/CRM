$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });
                var fokus = false;
                $("input").each(function(){
                    if($(this).is(':focus')){
                       fokus = true
                    }
                    if(fokus){
                        this.focus();
                        return false;
                    }


                });
            }
        });
    });
});