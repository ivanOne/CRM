
    function add(people,url,order_id) {
        $(document).ready(function() {
            if ($('#chat_inp').val().length === 0) {
                alert("Пустое сообщение")
            }
            else {
                var text = $(this).val();
                $.ajax({
                    url: url,
                    data: {people: people, order: order_id, text: text},
                    success: function (data) {
                        console.log(data)
                    }
                })
            }
        })
    }


    function update(){

    }

    function render(){

    }

