// CSS
import '../../css/auth/global.scss';

import $ from '../app';

$(document).ready(() => {
    $('form#registrationForm').submit((e) => {
        e.preventDefault();
        const fd = new FormData(e.target);

        $.ajax({
            url: '/api/register',
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            success(response) {
                if (response.responseText === '0') {
                    $('.box__error').text(`Rejestracja udana! Na podany adres e-mail (${fd.get('email')}) wysłaliśmy odnośnik aktywacyjny.`);
                }
            },
            error(errResponse) {
                if (errResponse.responseText === '100') {
                    $('.box__error').text('Konto o takiej nazwie użytkownika już istnieje!');
                }

                if (errResponse.responseText === '101') {
                    $('.box__error').text('Konto o takim adresie e-mail już istnieje!');
                }
            }
        });
    });
});
