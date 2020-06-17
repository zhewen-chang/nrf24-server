$(document).ready( function() {
    let level_arr = ["Low", "Mid", "High"];
    $.ajax("/exec/get-customer.php") 
    .done(function(res) {
        $("#ajax-body").empty().append(res);
        $('select').on('change', function(e) {
            let level = $(this).val();
            console.log(level_arr[level-1])
            let id = $(this).parent().parent().parent().find(".id")[0].innerHTML;
            $.ajax({
                    type: 'POST',
                    url: "/exec/update-level.php",
                    data: {"id": id, "level": level_arr[level-1]},
                }).done( function() {
                    M.toast({html: 'Successfully update level for id: '+ id + ', level: ' + level_arr[level-1] + '.'})
            });
        }).formSelect();
    })

});