$(document).ready( function() {
    setInterval( function() {
        $.ajax("/exec/getData.php") 
        .done(function(res) {
            $("#ajax-body").empty().append(res);

            $('.miss-time').each( function() {
                var time = parseInt($(this).text().split(" ")[0]);
                if (time < 15) {
                    $(this).addClass("green-text");
                } else if (time < 30) {
                    $(this).addClass("orange-text");
                } else {
                    if (time & 0x01) {
                        $(this).addClass("white-text");
                        $(this).removeClass("red-text");
                        $(this).parent().addClass("red lighten-2 white-text");
                    } else {
                        $(this).removeClass("white-text");
                        $(this).addClass("red-text");
                        $(this).parent().removeClass("red lighten-2 white-text");
                    }
                    $(this).parent().find("td.sign").text("Missing").css("font-weight", "bold");
                }
            });
        })
    }, 1000);
});