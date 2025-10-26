document.addEventListener('DOMContentLoaded', function () {
    // Підключаємо маску для всіх полів із класом .phone-input
    if (typeof IMask === 'undefined') {
        console.error('IMask не знайдено. Переконайся, що CDN підключений.');
        return;
    }

    document.querySelectorAll('.phone-input').forEach(function (input) {
        IMask(input, {
            mask: '+{380} (00) 000-0000',
            lazy: false, // показує шаблон навіть коли пусто
        });
    });

    // Перевірка перед відправкою форми
    document.querySelectorAll('form.need-validation').forEach(form => {
        form.addEventListener('submit', function (e) {
            const phoneInput = form.querySelector('.phone-input');
            if (!phoneInput) return;

            // Беремо цифри
            const raw = phoneInput.value.replace(/\D/g, '');
            const valid = /^380\d{9}$/.test(raw);

            if (!valid) {
                e.preventDefault();
                phoneInput.classList.add('invalid');
                alert('Введіть коректний номер у форматі +380 (XX) XXX-XXXX');
            } else {
                phoneInput.classList.remove('invalid');
                // перед сабмітом — перетворюємо значення в +380XXXXXXXXX
                phoneInput.value = '+' + raw;
            }
        });
    });
});
