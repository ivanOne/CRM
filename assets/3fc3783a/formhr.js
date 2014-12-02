$(document).ready(function(){
        var line = $(".tables tbody tr");
        var id = [];
        line.each(function(){
            id.push($(this).attr('id'))
        });

        for (var i = 0; i < id.length; i++) {
            var oneItog = 0;
            var twoItog = 0;
            var total = 0;
            $('[id='+id[i]+'][t=one] select').each(function(){
                if(($(this).val())==="1"){
                    oneItog++;
                }
            });
            $('[id='+id[i]+'][t=itogOne]').text(oneItog);
            $('[id='+id[i]+'][t=two] select').each(function(){
                if(($(this).val())==="1"){
                    twoItog++;
                }
            });
            $('[id='+id[i]+'][t=itogTwo]').text(twoItog);
            total = oneItog+twoItog;
            $('[id='+id[i]+'][t=itogo]').text(total);
        }
        function kinza(id){
            var oneItog = 0;
            var twoItog = 0;
            var total = 0;
            $('[id='+id+'][t=one] select').each(function(){
                if(($(this).val())==="1"){
                    oneItog++;
                }
            });
            $('[id='+id+'][t=itogOne]').text(oneItog);
            $('[id='+id+'][t=two] select').each(function(){
                if(($(this).val())==="1"){
                    twoItog++;
                }
            });
            $('[id='+id+'][t=itogTwo]').text(twoItog);
            total = oneItog+twoItog;
            $('[id='+id+'][t=itogo]').text(total);
        }
        $('select').change(function(){
           console.log($(this).attr('id'));
        });
});