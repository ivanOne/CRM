$(document).ready(function(){
    $("#add").click(function(){
        $(".inputList").append(function(count){
            count++;
            return "<div class='col-lg-6'><input type='text' name='partsName[]'></div><div class='col-lg-6'><input type='text' name='partsPrice[]'></div>";
        });
    });
});
