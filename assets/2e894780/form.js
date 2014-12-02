$(document).ready(function(){
    var count = 0;
        summ = 0;
    $("#add").click(function(){
        count++;
        $(".inputList").append(function(){

            return "<div idn="+count+" class='row'><div class='col-lg-7'><input idn="+count+" placeholder='Название' type='text' class='form-control' name='partsName[]'></div><div class='col-lg-3'><input idn="+count+" placeholder='Стоимость' type='text' class='form-control' name='partsPrice[]'></div><div idn='"+count+"' id='del' class='col-lg-2 btn btn-danger'>Удалить</div></div>";
        });
        $(".inputListU").append(function(){

            return "<div idn="+count+" class='row'><div class='col-lg-7'><input idn="+count+" placeholder='Название' type='text' class='form-control' name='serviceName[]'></div><div class='col-lg-3'><input idn="+count+" placeholder='Стоимость' type='text' class='form-control' name='servicePrice[]'></div><div idn='"+count+"' id='del' class='col-lg-2 btn btn-danger'>Удалить</div></div>";
        });
    });
    $("body").on('click','#del',function(){
        var delId = ($(this).attr('idn'));
        val1 = $('.inputList .row[idn='+delId+']');
        val2 = $('.inputListU .row[idn='+delId+']');
        val1.detach();
        val2.detach();
    });
    $("#addU").click(function(){
        $(".inputListU").append(function(){
            count++;
            return "<div idn="+count+" class='row'><div class='col-lg-7'><input idn="+count+" placeholder='Название' type='text' class='form-control' name='serviceName[]'></div><div class='col-lg-3'><input idn="+count+" placeholder='Стоимость' type='text' class='form-control' name='servicePrice[]'></div><div idn='"+count+"' id='del' class='col-lg-2 btn btn-danger'>Удалить</div></div>";
        });
    });
    $(".inputList").on('change','input[name="partsName[]"],input[name="partsPrice[]"]',function(){
        var idn = $(this).attr('idn');
        name = $('input[idn='+idn+'][name="partsName[]"]').val();
        price = $('input[idn='+idn+'][name="partsPrice[]"]').val();
        $('input[idn='+idn+'][name="serviceName[]"]').val(name);
        $('input[idn='+idn+'][name="servicePrice[]"]').val(price);
    });
    $(".inputListU").on('change','input[name="servicePrice[]"]',function(){
        var int = 0
        $('input[name="servicePrice[]"]').each(function(){
            int = parseInt($(this).val,10);
            console.log($(this).val);
            summ += int;
        });
        console.log(summ);
    })
});
