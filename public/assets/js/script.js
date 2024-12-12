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
                        const basketIcon = document.querySelector('#lg-bag a');
                        basketIcon.setAttribute('data-count', data.count);
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


    // delete the product from the admin list when the admin click on the delete button
    
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


        // retrieve the data from the basket and set them in the command table 
        document.getElementById("continue-btn").addEventListener("click", function() {
            const basketItems = [];
            
            document.querySelectorAll("#cart tbody tr").forEach(function(row) {
                const item = {
                    id: row.getAttribute("data-product-id"),
                    name: row.querySelector("td:nth-child(3)").textContent.trim(),
                    price: row.querySelector(".price").textContent.replace('€', '').trim(),
                    size: row.querySelector(".item-size").value,
                    quantity: row.querySelector(".item-quantity").value
                };
                basketItems.push(item);
            });
    
        
            fetch('/project%20final%20de%20poles/Commande/saveBasket', {

                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ basket: basketItems })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error("Server returned an error:", text);
                        throw new Error("Server error: " + text);
                    });
                }
                return response.json(); 
            })
            .then(response => response.json())
                .then(data => {
                    if(data) {
                        console.log(data)
                    }else {
                        alert('Error getting data');
                    }
                })
                .catch(() => {
                    alert('An error occurred while getting the data.');
                });
            
        });




    // Add a product from the details page 
    // document.querySelector('button.normal').addEventListener('click', () => {
    //     const productId = document.querySelector('.normal').getAttribute('data-product-id');
    //     const productSize = document.querySelector('#product-size').value;
    //     const productQuantity = document.querySelector('input[type="number"]').value;
    //     const productPhoto = document.querySelector('#main-image').getAttribute('src');
    //     const productName = document.querySelector('h4').textContent;
    //     const productPrice = document.querySelector('h2').textContent.replace('€', '');
    
    //     const productData = {
    //         id: productId,
    //         size: productSize,
    //         quantity: productQuantity,
    //         photo: productPhoto,
    //         name: productName,
    //         price: productPrice
    //     };
    
    //     fetch(document.querySelector('.normal').getAttribute('data-url'), {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify(productData),
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if(data.isNotLogged) {
    //             location.href = '/project%20final%20de%20poles/Sign_In/signIn';
    //             alert('You need to create an account to add products to the basket.');
    //         } else {
    //             document.querySelectorAll('div.icon-container').forEach(icon => updateBasketItemConfirmation(icon));
    //             const basketIcon = document.querySelector('#lg-bag a');
    //             basketIcon.setAttribute('data-count', data.count);
    
    //             // Show either the confirmation or the alert based on product existence
    //             const messageHTML = data.productExists 
    //                 ? `
    //                     <div class="add-alert">
    //                         <div class="alert-message">Product Is Already In Basket</div>
    //                         <div class="icon"><i class="fa-solid fa-xmark"></i></div>
    //                     </div>
    //                 `
    //                 : `
    //                     <div class="add-confirmation">
    //                         <div class="confirmation-message">Product Added Successfully</div>
    //                         <div class="icon"><i class="fa-solid fa-check"></i></div>
    //                     </div>
    //                 `;
    
    //             document.querySelector('section#prodetails').insertAdjacentHTML('afterbegin', messageHTML);
    
    //             const confirmationElement = document.querySelector('.add-confirmation');
    //             const alertElement = document.querySelector('.add-alert');
    
    //             setTimeout(() => {
    //                 if (confirmationElement) confirmationElement.style.display = 'none';
    //                 if (alertElement) alertElement.style.display = 'none';
    //             }, 3000);
    //         }
    //     })
    //     .catch(error => console.error('Error:', error));
    // });
    
    
    
});
