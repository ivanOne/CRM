$(document).ready(function(){
    $("#add").click(function(){
        $(".inputList").append(function(count){
            count++;
            return "<div class='col-lg-8'><input type='text' class='form_control' name='partsName[]'></div><div class='col-lg-4'><input type='text' class='form_control' name='partsPrice[]'></div>";
        });
    });
});
