const btnMenuMobile = document.querySelector('#btn-menu-mobile');
const menu = document.querySelector('#menu');

btnMenuMobile.onclick = () => {
    menu.classList.toggle('active');
    btnMenuMobile.classList.toggle('active');
}