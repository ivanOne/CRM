$(document).ready(function(){
    var line = $(".tables tbody tr");
    var id = [];
    line.each(function(){
        id.push($(this).attr('id'))
    });
    for(var i in id){
        console.log(i);
    }
});