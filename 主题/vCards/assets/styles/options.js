'use strict';
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        let TabItems = document.querySelectorAll('.options-tab li');
        let Notice = document.querySelector('.options-notice');
        let Version = document.querySelector('#theme-version');
        let Form = document.querySelector('.options-contain > form');
        let Content = document.querySelectorAll('.options-content');
        TabItems.forEach(function (item) {
            item.addEventListener('click', function () {
                sessionStorage.setItem('options-current', item.getAttribute('data-current'));
                TabItems.forEach(function (_item) {
                    return _item.classList.remove('active');
                });
                item.classList.add('active');

                if (item.getAttribute('data-current') === 'options-notice') {
                    Notice.style.display = 'block';
                    Form.style.display = 'none';
                } else {
                    Form.style.display = 'block';
                    Notice.style.display = 'none';
                }

                Content.forEach(function (_item) {
                    _item.style.display = 'none';
                    if (_item.classList.contains(item.getAttribute('data-current'))) _item.style.display = 'block';
                });
            });
        });
        /* 页面第一次进来 */
        if (sessionStorage.getItem('options-current')) {
            if (sessionStorage.getItem('options-current') === 'options-notice') {
                Notice.style.display = 'block';
                Form.style.display = 'none';
            } else {
                Form.style.display = 'block';
                Notice.style.display = 'none';
            }

            TabItems.forEach(function (item) {
                if (item.getAttribute('data-current') === sessionStorage.getItem('options-current')) {
                    item.classList.add('active');
                    Content.forEach(function (_item) {
                        if (_item.classList.contains(sessionStorage.getItem('options-current'))) _item.style.display = 'block';
                    });
                }
            });
        } else {
            TabItems[0].classList.add('active');
            Notice.style.display = 'block';
            Form.style.display = 'none';
        }

    });
})();
