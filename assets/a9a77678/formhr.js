$(document).ready(function(){
    $('select').change(function(){
        var line = $(".tables tbody tr");
        var id = [];
        line.each(function(){
            id.push($(this).attr('id'))
        });
        for (var i = 0; i < id.length; i++) {
            console.log($('[id=26][t=one]'));
        }
    });

});