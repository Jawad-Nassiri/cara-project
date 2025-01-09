document.addEventListener('DOMContentLoaded', () => {

    // Highlights the navigation link that matches the current page URL by adding the 'active' class.
    const navLinks = document.querySelectorAll('#navbar a');
    const currentHref = location.href.endsWith('/') ? location.href.slice(0, -1) : location.href;

    navLinks.forEach(navItem => {
        let navHref = navItem.href;
    
        if (navHref[navHref.length - 1] === '/') {
            navHref = navHref.slice(0, navHref.length - 1);
        }

        if (currentHref === navHref || (currentHref === "http://localhost/project%20final%20de%20poles" && navHref.endsWith("/product/index"))){
            navItem.classList.add('active');
        }
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

            // Add product in the basket after the basket's icon is clicked 
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

                    location.href = '/project%20final%20de%20poles/Sign_In/signIn';
                    alert('You need to create an account to add products to the basket.')

                }else {
                    // Change basket icon's styles that are clicked by user
                    updateBasketItemConfirmation(icon);
                    const basketIcon = document.querySelector('#lg-bag a');
                    basketIcon.setAttribute('data-count', data.count);
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


    
        // remove product from the basket after the remove icon is clicked using AJAX
        document.querySelectorAll('i#remove-product').forEach(removeIcon => {
            removeIcon.addEventListener('click', (event) => {
                const productId = event.target.getAttribute('data-id');
                const row = event.target.closest('tr');
                const productSize = row.querySelector('.item-size').value;
        
                fetch('/project final de poles/basket/removeFromBasket', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: productId, size: productSize }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove();
                        const basketIcon = document.querySelector('#lg-bag a');
                        basketIcon.setAttribute('data-count', data.count);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
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


    // delete product from the admin list when the admin click on the delete button
    
    document.querySelectorAll('button.delete-btn').forEach(deleteBtn => {
        deleteBtn.addEventListener('click', function (event) {
            const productId = this.getAttribute('data-id');
            const row = this.closest('tr');
            
            if (confirm('Are you sure you want to delete this product?')) {
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
            }

        });
        
    });


    // delete the user from the admin list when the admin click on the delete button
    document.querySelectorAll('.delete-user-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = button.getAttribute('data-id');
        
            if (confirm('Are you sure you want to delete this user?')) {
                const formData = new FormData();
                formData.append('id', userId);

                fetch(`/project%20final%20de%20poles/adminAddProduct/deleteUser/${userId}`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.closest('tr').remove();
                    } else {
                        alert('Error deleting user: ' + data.message);
                    }
                })
                .catch(() => {
                    alert('An error occurred while deleting the user.');
                });
            }
        });
    });

    

    // Edit the product from the admin list when the admin click on the edit button
    document.querySelectorAll('button.edit-btn').forEach((editBtn) => {
        editBtn.addEventListener('click', () => {
            let productId = editBtn.getAttribute('data-id')
            location.href = `/project%20final%20de%20poles/AdminAddProduct/editProduct/${productId}`;
        })
    })



    // Edit User account from the admin list when the admin click on the edit button
    document.querySelectorAll('.edit-user-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = button.getAttribute('data-id');
            location.href = `/project%20final%20de%20poles/AdminAddProduct/editUserAccount?userId=${userId}`;
        });
    });
    
    
    
    

    // Function to update the subtotal and the total amount in the basket
    function updateCart() {
        let totalAmount = 0;
    
        document.querySelectorAll('#cart tbody tr').forEach(row => {
            const priceCell = row.querySelector('td.price');
            const price = priceCell ? parseFloat(priceCell.textContent.replace('€', '').trim()) : 0;
    
            const quantityInput = row.querySelector('td .item-quantity');
            const quantity = quantityInput ? parseInt(quantityInput.value) : 0;
    
            const subtotal = price * quantity;
    
            const subtotalCell = row.querySelector('.item-subtotal');
            if (subtotalCell) {
                subtotalCell.textContent = `${subtotal.toFixed(2)}€`;
            }
    
            totalAmount += subtotal;
        });
    
        const totalAmountCell = document.querySelector('#total-amount');
        if (totalAmountCell) {
            totalAmountCell.textContent = `${totalAmount.toFixed(2)}€`;
        }
    }
    
    document.querySelectorAll('.item-quantity').forEach(input => {
        input.addEventListener('input', updateCart);
    });
    
    document.querySelectorAll('#remove-product').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = this.closest('tr'); 
            if (row) {
                row.remove(); 
                updateCart();
            }
        });
    });
    
    updateCart();


    // Add product from the details page 
    if (location.pathname.includes("Detail")) {
        document.querySelector('button.normal').addEventListener('click', () => {
            const productId = document.querySelector('.normal').getAttribute('data-product-id');
            const productSize = document.querySelector('#product-size').value;
            const productQuantity = document.querySelector('input[type="number"]').value;
            const productPhoto = document.querySelector('#main-image').getAttribute('src');
            const productName = document.querySelector('h4').textContent;
            const productPrice = document.querySelector('h2').textContent.replace('€', '');
        
            const productData = {
                id: productId,
                size: productSize,
                quantity: productQuantity,
                photo: productPhoto,
                name: productName,
                price: productPrice
            };
        
            fetch(document.querySelector('.normal').getAttribute('data-url'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(productData),
            })
            .then(response => response.json())
            .then(data => {
                if(data.isNotLogged) {
                    location.href = '/project%20final%20de%20poles/Sign_In/signIn';
                    alert('You need to create an account to add products to the basket.');
                } else {
                    document.querySelectorAll('div.icon-container').forEach(icon => updateBasketItemConfirmation(icon));
                    const basketIcon = document.querySelector('#lg-bag a');
                    basketIcon.setAttribute('data-count', data.count);
        
                    const messageHTML = data.productExists 
                        ? `
                            <div class="add-alert-message">
                                <div class="alert-message">Product Is Already In Basket</div>
                                <div class="icon"><i class="fa-solid fa-xmark"></i></div>
                            </div>
                        `
                        : `
                            <div class="add-confirmation">
                                <div class="confirmation-message">Product Added Successfully</div>
                                <div class="icon"><i class="fa-solid fa-check"></i></div>
                            </div>
                        `;
        
                    document.querySelector('section#prodetails').insertAdjacentHTML('afterbegin', messageHTML);
        
                    const confirmationElement = document.querySelector('.add-confirmation');
                    const alertElement = document.querySelector('.add-alert-message');
        
                    setTimeout(() => {
                        if (confirmationElement) confirmationElement.style.display = 'none';
                        if (alertElement) alertElement.style.display = 'none';
                    }, 3000);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }


    // redirection to the payment page after retrieving basket data
    if (location.pathname.includes('Basket')) {
        
        const continueBtn = document.getElementById('continue-btn');
    
        function getBasketData() {
            const basketItems = [];

            document.querySelectorAll('#product-tbody tr').forEach(row => {
                const price = row.querySelector('td.price') ? row.querySelector('td.price').innerText : 0;
                const size = row.querySelector('select.item-size') ? row.querySelector('select.item-size').value : '';
                const quantity = row.querySelector('input.item-quantity') ? row.querySelector('input.item-quantity').value : 0;
                const productId = row.querySelector('select.item-size') ? row.querySelector('select.item-size').getAttribute('data-product-id') : 0;

    
                basketItems.push({
                    price: price,
                    size: size,
                    quantity: quantity,
                    productId: productId,
                });
            });

            let data = JSON.stringify({ items: basketItems });


            return fetch('/project%20final%20de%20poles/Commande/getBasketData', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: data
            })
                .then(response => response.json())
                .then(data => {
                    basketCount = data.basket_count;
                })
                .catch(error => console.error('Error fetching basket count:', error));
        }


    
        continueBtn.addEventListener('click', function() {
            getBasketData().then(() => {
                if (basketCount !== 0) {
                    location.href = '/project%20final%20de%20poles/Payment/showPaymentPage';
                } else {
                    document.body.insertAdjacentHTML('afterbegin', `
                        <div class="basket-alert">
                            <div class="alert-message">Your Basket Is Empty</div>
                            <div class="icon"><i class="fa-solid fa-xmark"></i></div>
                        </div>
                    `);
    
                    setTimeout(() => document.querySelector('.basket-alert')?.remove(), 2000);
                }
            });
        });
    }
    
    


    // payment process
if (location.pathname.includes('showPaymentPage')) {
    document.querySelector('button.payment').addEventListener('click', function (event) {
        event.preventDefault();

        fetch('/project%20final%20de%20poles/Payment/processPayment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.text()) 
        .then(data => {
            try {
                const parsedData = JSON.parse(data);

                if (parsedData.success) {
                    document.body.insertAdjacentHTML('afterbegin', `
                        <div class="confirmation_alert_message">
                            <div class="confirmation-message">Payment processed successfully!</div>
                            <div class="icon"><i class="fa-solid fa-check"></i></div>
                        </div>
                    `);

                    updateBasketCount();

                    setTimeout(() => {
                        location.href = '/project%20final%20de%20poles/product/index';
                    }, 2000);
                } else {
                    console.error('Payment processing failed:', parsedData.message);
                }
            } catch (error) {
                console.error('Error parsing response:', error, data);
            }
        })
        .catch(error => {
            console.error('Error processing payment:', error);
        });
    });
}

function updateBasketCount() {
    fetch('/project%20final%20de%20poles/Basket/getBasketCount', { method: 'GET' })
        .then(response => response.json())
        .then(data => {
            if (data.basket_count !== undefined) {
                const basketIcon = document.querySelector('#lg-bag a');
                basketIcon.setAttribute('data-count', data.basket_count);
            }
        })
        .catch(error => {
            console.error('Error fetching basket count:', error);
        });
}

//form validation
if (location.pathname.includes('sign_UpForm')) {

    let usernameInput = document.querySelector('.username-input');
    let passwordInput = document.querySelector('.password-input');
    let emailInput = document.querySelector('.email-input');

    let usernameErrorMessage = document.querySelector('.username-error-message');
    let passwordErrorMessage = document.querySelector('.password-error-message');
    let emailErrorMessage = document.querySelector('.email-error-message');

    usernameInput.addEventListener('input', () => {
        if (usernameInput.value.length < 3) {
            usernameErrorMessage.textContent = 'Username must be at least 3 characters';
            usernameErrorMessage.style.color = 'red'; 
        } else {
            usernameErrorMessage.textContent = 'Username Valid';
            usernameErrorMessage.style.color = 'green'; 
        }
    });

    passwordInput.addEventListener('input', () => {
        if (passwordInput.value.length < 6) {
            passwordErrorMessage.textContent = 'Password must be at least 6 characters';
            passwordErrorMessage.style.color = 'red'; 
        } else {
            passwordErrorMessage.textContent = 'Password Valid';
            passwordErrorMessage.style.color = 'green'; 
        }
    });

    emailInput.addEventListener('input', () => {
        if (!emailInput.value.match(/\S+@\S+\.\S+/)) {
            emailErrorMessage.textContent = 'Invalid email format';
            emailErrorMessage.style.color = 'red';
        } else {
            emailErrorMessage.textContent = 'Email Valid';
            emailErrorMessage.style.color = 'green';
        }
    });

    // Event listener for form submission
    document.querySelector('.singUp-form').addEventListener('submit', (event) => {
        let isValid = true;

        if (usernameInput.value === '' || usernameInput.value.length < 3) {
            usernameErrorMessage.textContent = 'Username must be at least 3 characters';
            isValid = false;
        }

        if (passwordInput.value === '' || passwordInput.value.length < 6) {
            passwordErrorMessage.textContent = 'Password must be at least 6 characters';
            isValid = false;
        }

        if (emailInput.value === '' || !emailInput.value.match(/\S+@\S+\.\S+/)) {
            emailErrorMessage.textContent = 'Invalid email format';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
}









});