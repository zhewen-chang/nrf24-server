$(document).ready( function() {
    let level_arr = ["Low", "Mid", "High"];
    $.ajax("/exec/get-customer.php")
    .done(function(res) {
        $("#ajax-customer").empty().append(res);
        $('select').on('change', function(e) {
            let level = $(this).val();
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
    $.ajax("/exec/get-gateway.php")
    .done(function(res) {
        $("#ajax-gateway").empty().append(res);     
        $('input.gateway-id').on('change', function(e) {
            let id=$(this).val();
            let ip=$(this).parent().parent().children()[0].innerHTML;
            $.ajax({
                type: 'POST',
                url: "/exec/update-gateway.php",
                data: {"id": id, "ip":ip}
            })
            .done( function() {
                M.toast({html: 'Successfully update id for ip: '+ ip + ', id: ' +id+'.'})
            });                        
        })
        $('input.counter').on('change', function(e) {
            let counter=$(this)[0].checked;
            let ip=$(this).parent().parent().parent().children()[0].innerHTML;
            $.ajax({
                type: 'POST',
                url: "/exec/update-gateway.php",
                data: {"counter": counter, "ip":ip}
            })
            .done( function() {
                M.toast({html: 'Successfully update counter for ip: '+ ip + ', counter: ' +counter+'.'})

            });
        })    
    })


});