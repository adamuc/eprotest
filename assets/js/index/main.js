// CSS
import '../../css/index/global.scss';

import $ from '../app';

$(document).ready(() => {
    $('html, body').scrollTop(0);
    $('html, body').css({
        overflow: 'hidden',
        height: '100%'
    });

    $('#search').click(() => {
        // WIP
        $.ajax({
            url: '/cms/getClosest',
            type: 'POST',
            data: coordinates,
            success(response) {
                const r = $.parseJSON(response);
                $('html, body').css({
                    overflow: 'auto',
                    height: 'auto'
                });

                $('html, body').animate({
                    scrollTop: $('.result').offset().top
                }, 1500);
            },
            error(errResponse) {
                console.log(errResponse);
            }
        });
    });
});
