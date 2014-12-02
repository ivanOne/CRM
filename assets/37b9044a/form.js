$(document).ready(function(){
    $("#add").click(function(){
        $(".inputList").append(function(count){
            count++;
            return "<div class='col-lg-8'><input type='text' name='partsName[]'></div><div class='col-lg-4'><input type='text' name='partsPrice[]'></div>";
        });
    });
});
