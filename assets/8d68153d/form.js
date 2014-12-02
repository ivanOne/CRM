$(document).ready(function(){
    $("#add").click(function(){
        $(".inputList").append(function(count){
            count++;
            return "<div class='col-lg-9'><input placeholder='Название' type='text' class='form-control' name='partsName[]'></div><div class='col-lg-3'><input placeholder='Стоимость' type='text' class='form-control' name='partsPrice[]'></div>";
        });
    });
});
