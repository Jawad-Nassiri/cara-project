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
        

        // Onclick event for the basket icon 
        icon.addEventListener('click', () => {

            // Add the product in the basket after the basket's icon is clicked 
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
                if(data.isNotLogged) {
                    location.href = '/project%20final%20de%20poles/Sign_In/signIn'
                }else {
                    // Change basket icon's styles that are clicked by user
                    updateBasketItemConfirmation(icon);
                };
            })
            .catch(error => console.error('Error:', error));

        });
    });
    
    


    // Getting the product from basket and adding styles to them
    document.querySelectorAll('.pro').forEach(productElement => {
        const productId = productElement.querySelector('.icon-container').getAttribute('data-product-id');
        // productsData comes from the shop page 
        const isInBasket = productsData.some(item => item.id == productId);
    
        if (isInBasket) {
            const item = productElement.querySelector('.icon-container');
            const confirmationElement = item.previousElementSibling;
            const checkIcon = confirmationElement.querySelector('.fa-check');
            const messageElement = confirmationElement.querySelector('div.confirmation > p');

            messageElement.textContent = 'Item Added';
            item.classList.add('activeColor');
            confirmationElement.classList.add('activeColor');
            messageElement.classList.add('color');

            if (!checkIcon) {
                confirmationElement.innerHTML += '<i class="fa-solid fa-check color"></i>';
            }
        }
    });


    
        // Remove the product from the basket after the remove icon is clicked using AJAX
        document.querySelectorAll('i#remove-product').forEach(removeIcon => {
            removeIcon.addEventListener('click', (event) => {
                const productId = event.target.getAttribute('data-id');

                fetch('/project final de poles/basket/removeFromBasket', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: productId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        event.target.closest('tr').remove();
                    }
                })
                .catch(error => console.error('Error:', error));
            })
        });


        // Change basket icon's styles that are clicked by user
        function updateBasketItemConfirmation(item) {
        const confirmationElement = item.previousElementSibling;
        let checkIcon = confirmationElement.querySelector('.fa-check');
        const messageElement = confirmationElement.querySelector('div.confirmation > p');
    
        if (checkIcon) {
            messageElement.textContent = 'Already in basket!';
            checkIcon.remove();
    
            setTimeout(() => {
                messageElement.textContent = 'Item Added';
                if (!confirmationElement.querySelector('.fa-check')) {
                    checkIcon = document.createElement('i');
                    checkIcon.setAttribute('class', 'fa-solid fa-check');
                    confirmationElement.appendChild(checkIcon);
    
                    checkIcon.classList.add('color');
                }
            }, 3000);
        } else {
            checkIcon = document.createElement('i');
            checkIcon.setAttribute('class', 'fa-solid fa-check');
            confirmationElement.appendChild(checkIcon);
            messageElement.textContent = 'Item Added';
    
            checkIcon.classList.add('color');
        }
    
        item.classList.add('activeColor');
        confirmationElement.classList.add('activeColor');
        messageElement.classList.add('color');
    }


    // Removing the product form the admin list when the admin click on the delete button
    
    document.querySelectorAll('button.delete-btn').forEach(deleteBtn => {
        deleteBtn.addEventListener('click', function (event) {
            const productId = this.getAttribute('data-id');
            const row = this.closest('tr');
    
            fetch(`/project%20final%20de%20poles/adminAddProduct/deleteProduct/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.remove();
                } else {
                    alert('Error deleting product: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    
});
