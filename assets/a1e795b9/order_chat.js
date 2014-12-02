
    function add(people,url,order_id) {
        $(document).ready(function() {
            if ($('#chat_inp').val().length === 0) {
                alert("Пустое сообщение")
            }
            else {
                var text = $('#chat_inp').val();
                $.ajax({
                    url: url,
                    data: {people: people, order: order_id, text: text},
                    success: function (data){
                        rend(data)
                    }
                })
            }
        })
    }


    function update(){
        $(document).ready(function() {
            if ($('#chat_inp').val().length === 0) {
                alert("Пустое сообщение")
            }
            else {
                var text = $('#chat_inp').val();
                $.ajax({
                    url: url,
                    data: {people: people, order: order_id, text: text},
                    success: function (data){
                        console.log(data)
                    }
                })
            }
        })
    }

    function render(url){

        $.ajax({
            url: url,
            data: {order: order_id},
            success: function (data){
               var html = "<div class='panel panel-default'>" +
                   "<div class='panel-heading'>"+data.people+"</div> " +
                   "<div class='panel-body'" +
                   data.text +
                   "</div> " + "</div>";
               $("#order_chat").append(html);
            }
        })
    }

    function rend(data){
        var obj = JSON.parse(data);
        var html = "<div class='panel panel-default'>" +
            "<div class='panel-heading'>"+obj.people+"</div> " +
            "<div class='panel-body'>" +
            obj.text +
            "</div> " + "</div>";
        $("#order_chat").append(html);
    }

