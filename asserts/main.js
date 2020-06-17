$(document).ready( function() {
    setInterval( function() {
        $.ajax("/exec/getData.php") 
        .done(function(res) {
            $("#ajax-body").empty().append(res);

            $('.miss-time').each( function() {
                if ($(this).parent().find("td.sign").text() == 'Alive') {
                    var time = parseInt($(this).text().split(" ")[0]);
                    var level = $(this).parent().find("td.level").text();
                    let alert_time = 30;
                    if (level == 'Mid') {
                        alert_time = 50;
                    } else if (level == 'High') {
                        alert_time = 70;
                    }
                    if (time < alert_time/2) {
                        $(this).addClass("green-text");
                    } else if (time < alert_time) {
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
                } else {
                    $(this).text("-");
                }
            });

            let ds = new Date();
            let options = { year: 'numeric', month:'2-digit', day: '2-digit', hour: "2-digit", hour12: false , minute:　"2-digit", second: "2-digit" };
            $(".last-update span").text(ds.toLocaleDateString("zh-TW", options));
        })
    }, 1000);
});