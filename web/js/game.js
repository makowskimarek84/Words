$(document).ready(function () {

    var wordCount = 0;

    $.get(window.location.origin+ "/game/random", function (data, status) {
        $('#word').html(drawBricks(data));
    });


    $('#word_input').keypress(function (e) {
        // if enter was pressed
        if (e.which === 13 && $('#word_input').val()) {
            $.ajax({
                url: window.location.origin + "/game/check/" + $('#word_input').val(),
                type: 'GET',
                success: function(data){ 
                    $('#communication').empty();
                    $('#words_list').append('<figure>'+data+"</figure>");
                    $('#word_input').val(null);
                    wordCount++;
                    $('#summary_number').text(wordCount);
                },
                error: function(data) {
                    $('#communication').text(data.responseText);
                }
            });
        };
    });
    
    
    $('#save_score_button').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: window.location.origin + "/score",
            type: 'POST',
            data: { 
                'nickname': $('#save_score_form #nickname').val()
            },
            success: function(data){ 
                window.location.replace(window.location.origin + "/score");
            }
        });
    });
});

function drawBricks(str) {
    var i;
    var ret = '';
    var len = str.length;

    for(i = 0; i < len; i++) {
       ret = ret+'<figure>'+str.substr(i, 1)+'</figure>';
    }

    return ret
};