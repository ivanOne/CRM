$(document).ready(function(){

    function getAdsMan(url,ini,region){
        $.ajax({
            url:url,
            data:"region="+region,
            success: function(data){
                $('.adsMan[ini='+ini+']').text("");
                $('.adsMan[ini='+ini+']').text(''+data+'');
                $('.adsPay[ini='+ini+']').html("");
                $('.adsPay[ini='+ini+']').html(
                    "<input type='checkbox' class='adsPayment' ini="+ini+">"
                );
            }
        })
    }

    function sendToArchive(url,ini){
        var id = ini;
            id_abc = $('[ini='+ini+'] .adsid').text();
            addr = $('[ini='+ini+'] .adsaddr').text();
            date = $('[ini='+ini+'] .adsdate').text();
            region = $('#region[ini='+ini+']').val();
            man = $('[ini='+ini+'] .adsMan').text();

        $.ajax({
            url:url,
            data:{"id":id,"id_abc":id_abc,"addr":addr,"date":date,"region":region,"man":man},
            success: function(){
                $(".architem").empty();
                $(".architem").html("<td><p>Содержимое перенесено в архив:</p><p id='return' ini="+ini+">Восстановить</p></td>"
                );
            }
        })
    }

    function returnToArchive(url,ini){
        $.ajax({
            url:url,
            data:"id="+ini,
            success: function(data){
                $('.adsMan[ini='+ini+']').text("");
                $('.adsMan[ini='+ini+']').text(''+data+'');
                $('.adsPay[ini='+ini+']').html("");
                $('.adsPay[ini='+ini+']').html(
                    "<input type='checkbox' class='adsPayment' ini="+ini+">"
                );
            }
        })
    }


});
