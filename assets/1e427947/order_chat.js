
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
                    success: function (){
                        render(url,order_id)
                    }
                })
            }
        })
    }

    function render(url,order_id){

        $.ajax({
            url: url,
            data: {order: order_id,action: "get"},
            success: function (data){
                console.log(data)
            }
        })
    }

    function rend(data){
        var obj = JSON.parse(data);
        var html = "<div class='panel panel-danger'>" +
            "<div class='panel-heading'>" +
            "<h3 class='panel-title'>"+obj.people+"</h3>" +
            "</div> " +
            "<div class='panel-body'>" +
            obj.text +
            "</div> " + "</div>";
        $("#order_chat").append(html);
    }

