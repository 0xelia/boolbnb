const humburger = document.querySelector('.humburger');
const dropMenu = document.querySelector('.drop_menu');


humburger.addEventListener('click', function(){
    dropMenu.classList.add('animate__slideInRight', 'animate__animated');
});