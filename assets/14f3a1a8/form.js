$(document).ready(function(){
    $("#add").click(function(){
        $(".inputList").append(function(count){
            count++;
            return "<div class='col-lg-8'><input idin="+count+" placeholder='Название' type='text' class='form-control' name='partsName[]'></div><div class='col-lg-3'><input idin="+count+" placeholder='Стоимость' type='text' class='form-control' name='partsPrice[]'></div><div class='col-lg-1'>*</div>";
        });
    });
});
