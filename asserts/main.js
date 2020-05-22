$(document).ready( function() {
    setInterval( function() {
        window.location.reload();
    }, 1000);

    $('.miss-time').each( function() {
        var time = parseInt($(this).text().split(" ")[0]);
        if (time < 10) {
            $(this).addClass("green-text");
        } else if (time < 20) {
            $(this).addClass("yellow-text");
        } else if (time < 30) {
            $(this).addClass("orange-text");
        } else {
            $(this).addClass("red-text");
        }
    });
});