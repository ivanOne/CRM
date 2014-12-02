
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
                    success: function (){
                        $('#chat_inp').val("");
                        render(url,order_id)
                    }
                })
            }
        })
    }

    function render(url,order_id){
        $(document).ready(function() {
            $.ajax({
                url: url,
                data: {order: order_id, action: "get"},
                success: function (data) {
                    var ob = JSON.parse(data);
                    $("#order_chat").empty();
                    for (var i = 0; i !== ob.length; i++) {
                        rend(ob[i])
                    }
                }
            })
        })
    }

    function rend(data){
        var html = "<div class='panel panel-danger'>" +
            "<div class='panel-heading'>" +
            "<h3 class='panel-title'>"+data.people+"</h3>" +
            "</div> " +
            "<div class='panel-body'>" +
            data.text +
            "</div> " + "</div>";
        $("#order_chat").append(html);
    }

