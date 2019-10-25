// CSS
import '../../css/auth/global.scss';

import $ from '../app';

function validateEmail(email) {
    const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(String(email).toLowerCase());
}

$(document).ready(() => {
    $('form#registrationForm').submit((e) => {
        e.preventDefault();
        const fd = new FormData(e.target);

        if (fd.get('username') === '' || fd.get('email') === '' || fd.get('password') === '' || fd.get('rpassword') === '') {
            $('.box__error').text('Musisz wypełnić wszystkie pola!');
            return;
        }

        if (fd.get('username').length > 32 || fd.get('username').length < 4) {
            $('.box__error').text('Nazwa użytkownika musi mieścić się w zakresie od 4 do 32 znaków!');
            return;
        }

        if (fd.get('email').length > 254) {
            $('.box__error').text('Adres e-mail nie może mieć więcej niż 254 znaki!');
            return;
        }

        if (fd.get('password').length > 255 || fd.get('password').length < 8) {
            $('.box__error').text('Hasło musi się składać z od 8 do 255 znaków!');
            return;
        }

        if (!validateEmail(fd.get('email'))) {
            $('.box__error').text('Nieprawidłowy adres e-mail!');
            return;
        }

        if (fd.get('password') !== fd.get('rpassword')) {
            $('.box__error').text('Podane hasła się nie zgadzają!');
            return;
        }

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
                    $('.box__error').text('Nieprawidłowy adres e-mail!');
                }

                if (errResponse.responseText === '101') {
                    $('.box__error').text('Konto o takiej nazwie użytkownika już istnieje!');
                }

                if (errResponse.responseText === '102') {
                    $('.box__error').text('Konto o takim adresie e-mail już istnieje!');
                }
            }
        });
    });
});
