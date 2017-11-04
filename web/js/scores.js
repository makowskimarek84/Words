$(document).ready(function () {

    $('.take_challenge').click(function (e) {
        e.preventDefault();
        var id =  $(this).data('word-id');
        window.location.replace(window.location.origin + "/challenge/"+ id);
    });
    
    
});
