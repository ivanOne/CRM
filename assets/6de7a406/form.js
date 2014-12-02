$(document).ready(function(){
    var count = 0
    $("#add").click(function(){
        $(".inputList").append(function(){
            count++;
            return "<div idn="+count+" class='row'><div class='col-lg-7'><input idin="+count+" placeholder='Название' type='text' class='form-control' name='partsName[]'></div><div class='col-lg-3'><input idin="+count+" placeholder='Стоимость' type='text' class='form-control' name='partsPrice[]'></div><div idn='"+count+"' id='del' class='col-lg-2 btn btn-danger'>Удалить</div></div>";
        });
    });
    $("body").on('click','#del',function(){
        var delId = ($(this).attr('idn'));
        $('.row[idn='+delId+']').remove();
    });
});
