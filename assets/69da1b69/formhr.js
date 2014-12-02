$(document).ready(function(){
    var line = $(".tables tbody tr");
    var id = [];
    line.each(function(){
        id.push($(this).attr('id'))
    });
    for (var i = 0; i < id.length; i++) {
        console.log($('[id='+id[i]+'][t=one]'));
    }
});