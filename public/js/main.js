var url = 'http://ilike.com.devel/'

window.addEventListener('load', function () {
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //button like
    function like() {
        //despintar like
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url + 'images/heartred.png');

            $.ajax({
                url: url + 'like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado like');
                    }
                }
            });
            dislike();
        });
    }
    like();
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + 'images/heartblack.png');

            $.ajax({
                url: url + 'dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado dislike');
                    }
                }
            });
            like();
        });
    }
    dislike();
});

