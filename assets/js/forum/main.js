// CSS
import '../../css/forum/global.scss';
import $ from '../app';
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