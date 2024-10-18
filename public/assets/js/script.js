document.addEventListener('DOMContentLoaded', () => {

// this is for the nav's elements when they are clicked 
const navLinks = document.querySelectorAll('#navbar a');


navLinks.forEach(function(navItem) {
    
    navItem.addEventListener('click', function() {

        navLinks.forEach(item => item.classList.remove('active'));
        navItem.classList.add('active');
        
    });
});




// These are for the opening and closing the nav bar in tablet mode 
// const bar = document.getElementById('bar');
// const nav = document.getElementById('navbar');
// const close = document.getElementById('close');


// if(bar){
//     bar.addEventListener('click' , ()=>{
//         nav.classList.add('active');
//     });
// }

// if(close){
//     close.addEventListener('click' , ()=>{
//         nav.classList.remove('active');
//     });
// }


});

