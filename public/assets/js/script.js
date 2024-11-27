document.addEventListener('DOMContentLoaded', () => {
    
    // Highlights the navigation link that matches the current page URL by adding the 'active' class.
    const navLinks = document.querySelectorAll('#navbar a');
    
    navLinks.forEach(function(navItem) {

        if (location.href.indexOf(navItem.href) !== -1) {
            navItem.classList.add('active');
        }
    });


    // These are for the opening and closing the nav bar in tablet and mobile devices!!

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


    // Redirection to the product details page, retrieving the product ID when clicked.
    const productElements = document.querySelectorAll('div.pro');
    
    productElements.forEach(productElementLink => {
        productElementLink.addEventListener('click', () => {
            const productId = productElementLink.getAttribute("data-id");
            window.location.href = `/project%20final%20de%20poles/Detail/showProductDetails?id=${productId}`;
        });
    });


    let basketIcons = document.querySelectorAll('#basket-icon')
    console.log(basketIcons)

    basketIcons.forEach(basketIcon => {
        basketIcon.addEventListener('click', () => {
            const basketIconId = basketIcon.getAttribute("data-id");
            
        });
    });
    
});