document.addEventListener('DOMContentLoaded', () => {
    
    // Highlights the navigation link that matches the current page URL by adding the 'active' class.
    document.querySelectorAll('#navbar a').forEach(navItem => {
        if (location.href.includes(navItem.href)) navItem.classList.add('active');
    });


    // These are for the opening and closing the nav bar in tablet and mobile devices!!
    const bar = document.getElementById('bar'), nav = document.getElementById('navbar'), close = document.getElementById('close');
    if (bar) bar.addEventListener('click', () => nav.classList.add('active'));
    if (close) close.addEventListener('click', () => nav.classList.remove('active'));


    // Redirection to the product details page, retrieving the product ID when clicked.
    document.querySelectorAll('img.product-img').forEach(img => {
        img.addEventListener('click', () => location.href = `/project%20final%20de%20poles/Detail/showProductDetails?id=${img.dataset.id}`);
    });



    // Show/hide the confirmation message based on mouse enter and leave events on each basket icon
    
    document.querySelectorAll('div.icon-container').forEach((icon) => {

        const confirmationElement = icon.previousElementSibling;
        icon.addEventListener('mouseenter', () => confirmationElement.style.display = 'flex');
        icon.addEventListener('mouseleave', () => confirmationElement.style.display = 'none');
        

        
        icon.addEventListener('click', () => {
            
            // Toggle item added state and update the confirmation message with a check icon.
            updateBasketItemConfirmation(icon);



            // Add the product in the basket after the basket icon is clicked 
            const productId = icon.getAttribute("data-product-id")
            const url = icon.getAttribute('data-url')
            const productPhoto = icon.closest('.pro').querySelector('.pro .product-img').getAttribute('src')
            const productName = icon.closest('.pro').querySelector('.pro h5.product-name').textContent
            const productPrice = icon.closest('.pro').querySelector('.pro h4.product-price').textContent
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: productId,
                    photo: productPhoto,
                    name: productName,
                    price: productPrice,
                }),
            })
            .then(response => response.json())
            .then(data => {
            })
            .catch(error => console.error('Error:', error));

        });

    });



    // Remove the product from the basket after the remove icon is clicked 
    document.querySelectorAll('i#remove-product').forEach(removeIcon => {
        removeIcon.addEventListener('click', event => event.target.closest('tr').remove());
    });






    function updateBasketItemConfirmation(item) {
        const confirmationElement = item.previousElementSibling;


        item.classList.toggle('activeColor');
        let checkIcon = confirmationElement.querySelector('.fa-check');

        if (!checkIcon) {
            checkIcon = document.createElement('i');
            checkIcon.setAttribute('class', 'fa-solid fa-check');
            checkIcon.classList.add('color');
            confirmationElement.appendChild(checkIcon);
            confirmationElement.querySelector('div.confirmation > p').innerHTML = 'Item Added';
        } else {
            confirmationElement.removeChild(checkIcon);
            confirmationElement.querySelector('div.confirmation > p').innerHTML = 'Add To Basket';
        }
        confirmationElement.classList.toggle('activeColor');
        confirmationElement.querySelector('div.confirmation > p').classList.toggle('color');
    
    }


    // Remove the product from the basket after the remove icon is clicked 
    function removeFromBasket(productId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'url', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
        xhr.send('product_id=' + productId);
    
        xhr.onload = function() {
            if (xhr.status == 200) {
                console.log('Product removed successfully');
            } else {
                console.log('Error removing product');
            }
        };
    }

// Listen for click event on the remove icon
    document.querySelector('tbody').addEventListener('click', function(event) {
        if (event.target && event.target.id === 'remove-product') {
            const productId = event.target.getAttribute('data-id');
            removeFromBasket(productId);
        }
    });


});
