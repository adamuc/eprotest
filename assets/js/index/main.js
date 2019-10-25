// CSS
import '../../css/index/global.scss';

import $ from '../app';

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

    function getClosestAndDisplay(data) {
        $.ajax({
            url: '/api/getClosest',
            type: 'POST',
            data,
            success(rawProtestArray) {
                const protestArray = $.parseJSON(rawProtestArray);
                $('.result').empty();
                if (protestArray.length !== 0) {
                    $('.result').append('<h2 class="result__header">Lista protestów w twojej okolicy</h2>');
                    $.each(protestArray, (i, protest) => {
                        // TODO: przetwarzanie czasu rozpoczęcia (protest.date
                        // w bazie danych) osobno na dzień, miesiąc i rok
                        const day = '10';
                        const month = 'lipca';
                        const year = '2020';

                        $('.result').append(`
                        <div class="result__box">
                            <img src="${protest.bgimage}" alt="" class="result__bg">
                            <div class="result__location">
                                <img src="{{ asset('image/location.png') }}" alt="" class="result__locationIcon">
                                <p class="result__city">
                                    ${protest.location1},
                                </p>
                                <p class="result__street">
                                    ${protest.location2}
                                </p>
                            </div>
                            <div class="result__details">
                                <div class="result__logo"><img src="${protest.logo}" alt="" class="result__logoImage"></div>
                                <div class="result__date"><span class="result__date--bigger">${day}</span>${month} ${year}</div>
                                <div class="result__title">${protest.title}</div>
                                <div class="result__author">
                                    <img src="${protest.author.avatar}" alt="" class="result__authorImage">
                                    <p class="result__authorName">${protest.author.username}</p>
                                </div>
                            </div>
                        </div>
                        `);
                    });
                } else {
                    $('.result').append(`<h2 class="result__header">Nie znaleźliśmy żadnych protestów w promieniu ${range} km :(</h2>`);
                }

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
    }

    function search() {
        $('.wrapper__searchList').empty();
        let input = $('#searchInput').val();
        input = input.replace(/ /g, '+');
        $.ajax({
            url: `https://nominatim.openstreetmap.org/search?q=${input}&countrycodes=pl&format=json&limit=5&dedupe=1`,
            type: 'POST',
            success(r) {
                $.each(r, (i, object) => {
                    $('.wrapper__searchList').append(`<div class="wrapper__listItem" id="${i}">${object.display_name}</div>`);
                });
                $('.wrapper__searchList').show();

                $('.wrapper__listItem').click((e) => {
                    const { id } = e.target;
                    const range = $('#range').val();

                    $('#searchInput').val(r[id].display_name);
                    const data = [r[id].lat, r[id].lon, range];
                    getClosestAndDisplay(data);
                });
            },
            error(errResponse) {
                console.log(errResponse);
            }
        });
    }

    $('#searchLocation').click(() => { search(); });
    $('#searchInput').keypress((keypress) => {
        if (keypress.which === 13) search();
    });

    $('#detectLocation').click(() => {
        navigator.geolocation.getCurrentPosition((pos) => {
            const range = $('#range').val();
            const data = [pos.coords.latitude, pos.coords.longitude, range];
            getClosestAndDisplay(data);
        });
    });
});
