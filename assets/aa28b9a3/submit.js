$(document).ready(function() {
    $(document).ready(function(){
        $("form").keypress(function(e){
            if(e.keyCode==13){
                $('form').submit(function () {
                    return false;
                });
                var i = $('#OrdersForm_technics').index();
                console.log(i);
            }
        });
    });
});