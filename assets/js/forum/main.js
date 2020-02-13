// CSS
import '../../css/forum/global.scss';

import $ from '../app';
<<<<<<< HEAD
$(document).ready(() =>{
    function menu() {
        let click = false;
        let clickArrow = false;
        $('.hamburger').click(() =>{
            if(click == false){
                $('.navigation__menu').addClass('navigation__menu--active');
                click = true;
            }else{
                $('.navigation__menu').removeClass('navigation__menu--active');
                click = false;
            }
        });
        $('.arrow').click(() =>{
            if(clickArrow == false){
                $('.userMenu').fadeIn(300);
                $('.userMenu').css('display', 'flex');
                clickArrow = true;
            }else{
                $('.userMenu').fadeOut(300);
                clickArrow = false;
            }
        });
    }

    function loadContent(index) {
        $('.loaderBox').fadeIn(250);
        setTimeout(function () {
            $('.loadBox').load(index, function () {
                $('.loaderBox').fadeOut(250);
            });
        }, 1000);
    }
    function category() {
        $('.event').click(() =>{
           let category = $('.event').attr('class').split(' ');
           switch(category[1]){
               case 'ecoEvent':
                   loadContent('eco.html');
           }
        });
    }
    category();
    menu();
});
=======

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
>>>>>>> 480d4f9412c999cf3feb028a1db66665e8915488
