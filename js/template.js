$(document).ready(function(){
    function resize(){
        var res = $(window).width();
        if(res <= 1200 && res >= 400 ) {
            $(".portlet ul.nav").removeClass("nav-stacked");
            $(".widgetTime").addClass('hidden');
            $("#but").removeClass('hidden');
        }
        else{
            $(".widgetTime").removeClass('hidden');
            $("#but").addClass('hidden');
            $("#yw3").addClass("nav-stacked");
        }
    }

    $('#but').click(function(){
        var radio = $('.widgetTime').is('.hidden');
        console.log(radio);
        if(radio){
            $(".widgetTime").removeClass('hidden');
            $("#but").addClass('fa-rotate-90');
        }
        else{
            $(".widgetTime").addClass('hidden');
            $("#but").removeClass('fa-rotate-90');
        }

    });
    resize();
    $(window).resize(function(){
        resize();
    });
});
