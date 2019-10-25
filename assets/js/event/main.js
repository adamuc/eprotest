// CSS
import '../../css/event/global.scss';

import $ from '../app';
import '../leaflet';

$(document).ready(() => {
    const id = window.location.hash.substr(1);

    $('.wrapper__user').hover(() => {
        $('.wrapper__userOption').fadeIn(300);
    }, () => {
        $('.wrapper__userOption').fadeOut(300);
    });

    const mapArgs = {
        center: [17.385044, 78.486671],
        zoom: 10
    };
    const map = new L.map('map', mapArgs);
    const layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);

});
