const burger = document.querySelector('.burger');

const nav = document.querySelector('.main-navigation');

if (burger && nav) {

    burger.addEventListener('click', () => {

        const isOpen = nav.classList.toggle('active');

        burger.setAttribute('aria-expanded', String(isOpen));

    });

}

// FAQ accordion — each item toggles independently, no single-open
// constraint, so opening one never unexpectedly closes another the
// visitor already had open
document.querySelectorAll('.faq__question').forEach((button) => {

    button.addEventListener('click', () => {

        const item = button.closest('.faq__item');
        const answer = document.getElementById(button.getAttribute('aria-controls'));

        if (!item || !answer) return;

        const isOpen = button.getAttribute('aria-expanded') === 'true';

        button.setAttribute('aria-expanded', String(!isOpen));
        answer.hidden = isOpen;
        item.classList.toggle('is-open', !isOpen);

    });

});
