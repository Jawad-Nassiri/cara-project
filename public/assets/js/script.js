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
    const productImgElements = document.querySelectorAll('img.product-img');
    
    productImgElements.forEach(productImgElementLink => {
        productImgElementLink.addEventListener('click', () => {
            const productId = productImgElementLink.getAttribute("data-id");
            window.location.href = `/project%20final%20de%20poles/Detail/showProductDetails?id=${productId}`;
        });
    });



    // Show/hide the confirmation message based on mouse enter and leave events on each basket icon
    const basketIcons = document.querySelectorAll('div.icon-container')

    
    basketIcons.forEach((icon) => {

        const confirmationElement = icon.previousElementSibling;

        icon.addEventListener('mouseenter', () => {
                confirmationElement.style.display = 'flex';
        })


        icon.addEventListener('mouseleave', () => {
            confirmationElement.style.display = 'none';
        })
        

        
        // Toggle item added state and update the confirmation message with a check icon.
        icon.addEventListener('click', () => {

            icon.classList.toggle('activeColor')
            let checkIcon = confirmationElement.querySelector('.fa-check');

            if(!checkIcon) {
                checkIcon = document.createElement('i')
                checkIcon.setAttribute('class' , 'fa-solid fa-check')
                checkIcon.classList.add('color')
                confirmationElement.appendChild(checkIcon)
                confirmationElement.querySelector('div.confirmation > p').innerHTML = 'Item Added'

            }else{
                confirmationElement.removeChild(checkIcon)
                confirmationElement.querySelector('div.confirmation > p').innerHTML = 'Add To Basket'

            }
            confirmationElement.classList.toggle('activeColor')
            confirmationElement.querySelector('div.confirmation > p').classList.toggle('color')


            // Set the clicked products to the Basket
            const subTotal = document.querySelector('.basket-product-container')
            console.log(subTotal)
            const productElement = icon.closest('div.pro')
            const productId = productElement.querySelector('img').getAttribute('data-id')
            const productName = productElement.querySelector('h5').getAttribute('data-product-name')
            const productPrice = productElement.querySelector('h4').getAttribute('data-product-price')
            const productPhoto = productElement.querySelector('img').getAttribute('data-product-photo')

            basketProductContainer.insertAdjacentElement('beforeend', `
                <tr>
                <td><i class="fa-solid fa-trash"></i></td>
                <td><img src="/project%20final%20de%20poles/public/assets/images/products/f1.jpg"></td>
                <td>Sample Product</td>
                <td>$10.00</td>
                <td>
                    <select>
                        <option value="small" selected>Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                        <option value="x-large">X-Large</option>
                    </select>
                </td>
                <td><input type="number" min="1" value="1"></td>
                <td>$10.00</td>
            </tr>
            `)


        })

    })



});