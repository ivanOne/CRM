$(document).ready(function(){
    var count = 0;

    function ini(){
        obj = $('[name="serviceName[]"]').size();
        count = obj;
    }

    $("#add").click(function(){
        ini();
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
            ini();
            count++;
            console.log(count);
            return "<div idn="+count+" class='row'><div class='col-lg-5'>" +
            "<input idn="+count+" placeholder='Название' type='text' class='form-control' name='service["+count+"][name]'></div>" +
            "<div class='col-lg-2 text-right'><span>Скидка </span><input idn="+count+" name='service["+count+"][discount]'  type='checkbox'></div>"+
            "<div class=col-lg-3><input idn="+count+" placeholder='Стоимость' type='text' class='form-control' name='service["+count+"][price]'></div>" +
            "<div idn='"+count+"' id='del' class='col-lg-2 btn btn-danger'>Удалить</div></div>";
        });
    });
    $(".inputList").on('change','input[name="partsName[]"],input[name="partsPrice[]"]',function(){
        var idn = $(this).attr('idn');
        name = $('input[idn='+idn+'][name="partsName[]"]').val();
        price = $('input[idn='+idn+'][name="partsPrice[]"]').val();
        $('input[idn='+idn+'][name="serviceName[]"]').val(name);
        $('input[idn='+idn+'][name="servicePrice[]"]').val(price);
    });
    $("body").on('click','#refresh',function(){
        var int = 0;
        summ = 0;
        discountSumm = 0;
        $('input[name="servicePrice[]"]').each(function(){
            idnn = $(this).attr('idn');
            if($("input[idn="+idnn+"][name='discount[]']").prop("checked")){
                discountSumm += parseInt($(this).val(),10);
            }
            else{
                summ += parseInt($(this).val(),10);
            }

        });
        total = summ+discountSumm;
        $('input[name="itog"]').val(total);
        discount = parseInt($('input[name="OrdersForm[discount]"]').val());
        check = 0;
        if(!isNaN(discount)){
            check = discountSumm*(100-discount)/100;
            check = parseInt(check+summ);
            $('input[name="OrdersForm[total]"]').val(check);
        }
        else{
            $('input[name="OrdersForm[total]"]').val(total);
        }
        len = $('input[name="partsPrice[]"]').size();
        var summParts = 0;
        profit = 0;
        if(len>0){
            $('input[name="partsPrice[]"]').each(function(){
                summParts += parseInt($(this).val());
            });
            tot = $('input[name="OrdersForm[total]"]').val();
            profit = tot - summParts;
        }
        else{
            profit = summ;
        }
        $('input[name="OrdersForm[profit]"]').val(profit);

    });

});
