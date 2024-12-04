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
    table-layout: fixed;
}

thead {
    background-color: #f4f4f4;
    display: table;
    width: calc(100% - 16px);
}

thead th, tbody td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

tbody {
    display: block;
    max-height: 350px;
    overflow-y: scroll;
    width: 99%;
}

tbody::-webkit-scrollbar {
    width: 5px;
}

tbody::-webkit-scrollbar-thumb {
    background-color: #888;
}

tbody::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

tbody::-webkit-scrollbar-track {
    background: #f1f1f1;
}

tbody tr, thead tr {
    display: table;
    width: 100%;
    table-layout: fixed; 
}

tbody tr td img {
    width: 60px;
    height: 60px;
    object-fit: cover;
}

tbody tr td #remove-product {
    color: #088178;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

tbody tr td #remove-product:hover {
    color: red;
}

.remove-icon {
    color: red;
    text-decoration: none;
    font-size: 20px;
    cursor: pointer;
}

select, input[type="number"] {
    width: 85px;
    padding: 5px;
    outline: 0;
}

#cart.section-p1 {
    overflow-x: auto;
    margin: 20px auto;
    width: 90%;
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
    <p>Your selected products</p>
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
        <tbody>
            <?php if (!empty($basket)): ?>   
                <?php foreach ($basket as $item): ?>
                    <tr id="product-row" data-product-id="<?= $item['id']; ?>">
                        <td><i class="fa-solid fa-trash" id="remove-product" data-id="<?= $item['id']; ?>"></i></td>
                        <td><img src="<?= $item['photo']; ?>" alt="<?= $item['name']; ?>"></td>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['price']; ?>€</td>
                        <td>
                            <select class="item-size">
                                <option value="small" selected>Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="x-large">X-Large</option>
                            </select>
                        </td>
                        <td><input type="number" min="1" value="1" class="item-quantity"></td>
                        <td class="item-subtotal"><?= $item['price']; ?>€</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Your basket is empty.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<section id="cart-add" class="section-p1">
    <div id="subtotal">
        <h3>Cart Total</h3>
        <table>
            <tr>
                <td><strong>Total</strong></td>
                <td id="total-amount"><strong>0€</strong></td>
            </tr>
        </table>
        <a href="#">Continue</a>
    </div>
</section>