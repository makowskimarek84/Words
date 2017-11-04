$(document).ready(function () {

    $('#menu_score').click(function (e) {
        e.preventDefault();
        window.location.replace(window.location.origin + "/score");
    });
    
    $('#menu_new_game').click(function (e) {
        e.preventDefault();
        window.location.replace(window.location.origin);
    });
    
});
