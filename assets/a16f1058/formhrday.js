/**
 * Created by 123 on 16.10.2014.
 */
$(document).ready(function() {
    $('select').change(function () {
        var id = $(this).attr('id');
        var date = $(this).attr('date');
        var val = $(this).val();
        console.log(date);
        $.ajax({
            type: "POST",
            url: "index.php",
            data: "r=ajax/settimestatus&id=" + id + "&date=" + date + "&status=" + val + ""
        });
    });
});