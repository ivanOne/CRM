$(document).ready(function(){
    var line = $(".tables tbody tr");
    var item;
    line.each(function(){
       item = $("[t=one] select").val;
        console.log(item);
    });
});