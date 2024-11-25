document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('#navbar a');
    
    navLinks.forEach(function(navItem) {

        if (location.href.indexOf(navItem.href) !== -1) {
            navItem.classList.add('active');
        }
    });
});




// These are for the opening and closing the nav bar in tablet mode 

const bar = document.getElementById('bar');
const nav = document.getElementById('navbar');
const close = document.getElementById('close');


if(bar){
    bar.addEventListener('click' , ()=>{
        nav.classList.add('active');
    });
}

if(close){
    close.addEventListener('click' , ()=>{
        nav.classList.remove('active');
    });
}