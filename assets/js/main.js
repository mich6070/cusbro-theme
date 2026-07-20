const burger = document.querySelector('.burger');

const nav = document.querySelector('.main-navigation');

if (burger && nav) {

    burger.addEventListener('click', () => {

        const isOpen = nav.classList.toggle('active');

        burger.setAttribute('aria-expanded', String(isOpen));

    });

}
