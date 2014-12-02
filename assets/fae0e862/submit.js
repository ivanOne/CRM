$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });
                var fokus = false;
                $("input textarea select").each(function(){
                    if(fokus){
                        this.focus();
                        return false;
                    }
                    if($(this).is(':focus')){
                        console.log(this);
                       fokus = true
                    }

                });
            }
        });
    });
});