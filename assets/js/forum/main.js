// CSS
import '../../css/forum/global.scss';

import $ from '../app';

$(document).ready(() => {
    $('.wrapper__user').hover(() => {
        $('.wrapper__userOption').fadeIn(300);
    }, () => {
        $('.wrapper__userOption').fadeOut(300);
    });

    $('#addEvent').click(() => {
        window.location.href = '/addevent';
    });

    $('#openProfile').click(() => {
        window.location.href = '/profile';
    });

    $('#openSettings').click(() => {
        window.location.href = '/settings';
    });

    $('#logout').click(() => {
        window.location.href = '/logout';
    });
});
