    <style>

#basket-page-header {
    position: relative;
    background-image: url('/project%20final%20de%20poles/public/assets/images/banners/basket-banner.jpg');
    background-position: center; 
    background-position-y: -40px; 
    width: 100%;
    height: 30vh;
    background-size: cover;
    display: flex;
    justify-content: center;
    text-align: center;
    flex-direction: column;
    padding: 14px;
    overflow: hidden; 
}

#basket-page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 0; 
}

#basket-page-header * {
    position: relative;
    z-index: 1; 
    color: #fff;
}
    
#cart {
    overflow-x: auto;
}

#cart table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    white-space: nowrap;
}

#cart table thead {
    border: 1px solid #e2e9e1;
    border-left: none;
    border-right: none;
}

#cart table thead td {
    padding: 18px 0;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 13px;
}

#cart table img {
    width: 70px;
}

#cart table td:nth-child(1) {
    width: 100px;
    text-align: center;
}

#cart table td:nth-child(3) {
    width: 250px;
    text-align: center;
}

#cart table td:nth-child(2),
#cart table td:nth-child(4),
#cart table td:nth-child(5),
#cart table td:nth-child(6) {
    width: 150px;
    text-align: center;
}

#cart table td:nth-child(5) input {
    width: 70px;
    padding: 10px 5px 10px 15px;
}

#cart table td:nth-child(5) select {
    width: 80px;
    padding: 8px 10px;
    font-size: 13px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    appearance: none;
    text-align: center;
}

#cart table td:nth-child(5) select:focus {
    outline: none;
    border-color: #088178;
}

#cart table tbody tr {
    border: 1px solid #e2e9e1;
}

#cart table tbody tr td {
    font-size: 13px;
    padding: 5px 0;
}

#cart table tbody tr td * {
    vertical-align: middle;
}

#cart-add {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

</style>
    
    
    
    
    <section id="basket-page-header" class="about-header">
        <h2>#Basket</h2>
        <p>Leave a message, we love to hear from you!</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Price</td>
                    <select>
                        <option>Select Size</option>
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">(L) Large</option>
                        <option value="XL">(XL) Extra Large</option>
                        <option value="XXL">(XXL) 2X Large</option>
                    </select>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#"><i class="far fa-times-circle"></i></a></td>
                    <td><img src="/project%20final%20de%20poles/public/assets/images/products/f1.jpg" alt=""></td>
                    <td>Lorem ipsum dolor sit.</td>
                    <td>118€</td>
                    <td><input type="number" value="1"></td>
                    <td>118€</td>
                </tr>
            </tbody>
        </table>
    </section>


    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>335€</strong></td>
                </tr>
            </table>
            <a href="#">Continue</a>
        </div>
    </section>