$(document).ready(function(){
    var line = $(".tables tbody tr");
    var id = [];
    line.each(function(){
        id.push($(this).attr('id'))
    });
    id.each(function(){
       console.log(this);
    });
    var item = [];

});