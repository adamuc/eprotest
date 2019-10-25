// CSS
import '../../css/eventAdd/global.scss';
import $ from '../app';
$(document).ready(() =>{
    $('.wrapper__user').hover(()=>{
        $('.wrapper__userOption').fadeIn(300);
    }, ()=>{
        $('.wrapper__userOption').fadeOut(300);
    });
    var mymap = L.map('mapid').setView([51.505, -0.09], 13);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    }).addTo(mymap);
});
