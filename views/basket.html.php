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

    table {
        width: 90%;
        margin: auto;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }

    tbody tr td img {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }

    .remove-icon {
        color: red;
        text-decoration: none;
        font-size: 20px;
        cursor: pointer;
    }

    select, input[type="number"] {
        width: 80px;
        padding: 5px;
        outline: 0;
    }

    #cart.section-p1 {
        overflow-x: auto;
        margin: 20px auto;
        width: 90%;
    }

    #cart.section-p1 table {
        width: 100%;
        min-width: 700px;
    }

    #subtotal {
        width: 50%;
        margin-bottom: 30px;
        border: 1px solid #e2e9e1;
        padding: 30px;
    }

    #subtotal table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    #subtotal table td {
        width: 50%;
        border: 1px solid #e2e9e1;
        padding: 10px;
        font-size: 13px;
    }

    #subtotal a {
        text-decoration: none;
        display: block;
        color: #fff;
        background: #088178;
        width: 120px;
        padding: 8px 10px;
        border-radius: 4px;
        font-size: 16px;
        text-align: center;
    }
</style>

<section id="basket-page-header" class="about-header">
    <h2>#Basket</h2>
    <p>Leave a message, we love to hear from you!</p>
</section>

<section id="cart" class="section-p1">
    <table>
        <thead>
            <tr>
                <th>Remove</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody class="basket-product-container">
            
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

<!-- <script>
    const subTotal = document.querySelector('.basket-product-container')
    console.log(subTotal)
</script> -->
