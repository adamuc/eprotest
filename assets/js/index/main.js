// CSS
import '../../css/index/global.scss';

import $ from '../app';

let input;
let coordinates;

$(document).ready(() => {
    $('html, body').scrollTop(0);
    $('html, body').css({
        overflow: 'hidden',
        height: '100%'
    });
    
    $('.wrapper__searchList').hide();
    $(window).click(() => {
        $('.wrapper__searchList').hide();
    });

    $('#searchLocation').click(() => {
        $('.wrapper__searchList').empty();
        input = $('#searchInput').val();
        input = input.replace(/ /g, '+');
        $.ajax({
            url: `https://nominatim.openstreetmap.org/search?q=${input}&countrycodes=pl&format=json&limit=5`,
            type: 'POST',
            success(r) {
                //const r = $.parseJSON(response);
                $.each(r, (i, object) => {
                    $('.wrapper__searchList').append(`<div class="wrapper__listItem" id="${i}">${object.display_name}</div>`);
                });

                $('.wrapper__searchList').show();
            },
            error(errResponse) {
                console.log(errResponse);
            }
        });
    });

    //$('#searchLocation').click(() => {
        // WIP
        /*$.ajax({
            url: '/api/getClosest',
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
        });*/
    //});
});
