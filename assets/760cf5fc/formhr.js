$(document).ready(function(){
        var line = $(".tables tbody tr");
        var id = [];
        line.each(function(){
            id.push($(this).attr('id'))
        });

        for (var i = 0; i < id.length; i++) {
            var oneItog = 0;
            $('[id='+id[i]+'][t=one] select').each(function(){
                if(($(this).val())==="1"){
                    oneItog++;
                }
            });
            $('[id='+id[i]+'][t=itogOne]').text(oneItog);
        }

});