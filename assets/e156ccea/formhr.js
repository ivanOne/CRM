$(document).ready(function(){
        var line = $(".tables tbody tr");
        var id = [];
        line.each(function(){
            id.push($(this).attr('id'))
        });
        for (var i = 0; i < id.length; i++) {
            $('[id='+id[i]+'][t=one] select').each(function(){
                console.log($(this).val);
            });
        }

});