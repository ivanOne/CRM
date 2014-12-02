$(document).ready(function(){
    var line = $(".tables tbody tr");
    var item = [];
    line.each(function(){
        item.push(this.cells);
    });
    console.log(item.attr('t'));
});