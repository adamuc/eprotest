// CSS
import '../../css/forum/global.scss';
import $ from '../app';
$(document).ready(() =>{
    $('.wrapper__user').hover(()=>{
        $('.wrapper__userOption').fadeIn(300);
    }, ()=>{
        $('.wrapper__userOption').fadeOut(300);
    });

});