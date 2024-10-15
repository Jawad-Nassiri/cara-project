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



// this is for the nav's elements when they are clicked 
const navLinks = document.querySelectorAll('#navbar a');
console.log(navLinks)

navLinks.forEach(function(navItems) {

    navLinks.forEach(navItems => navItems.classList.remove('active'));

    navItems.classList.add('active');
})








