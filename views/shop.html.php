<section id="page-header">
    <h2>#Stay-home</h2>
    <p>Save more with coupons & up to 70% off!</p>
</section>

<section id="product1" class="section-p1">
    <div class="pro-container">
        <?php foreach ($products as $product): ?>
            <div class="pro">

                <img src="/project%20final%20de%20poles/public/assets/images/products/<?= htmlspecialchars($product->getPhoto()); ?>"
                class="product-img"
                data-id="<?= $product->getId() ?>"
                alt="<? htmlspecialchars($product->getTitre()); ?>">

                <div class="des">
                    <span><?= htmlspecialchars($product->getMarque()) ?></span>

                    <h5 class="product-name">
                        <?= htmlspecialchars($product->getTitre()) ?>
                    </h5>
                    <div class="star">
                        <?php
                            $randomStars = rand(3, 5);
                        ?>
                        <?php for ($i = 0; $i < $randomStars; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>

                    <h4 class="product-price">
                        <?= htmlspecialchars($product->getPrix()) ?>€
                    </h4>
                </div>

                <div class="confirmation">
                    <p>Add To Basket</p>
                </div>

                <div class="icon-container" data-product-id="<?= $product->getId() ?>" data-url = "<?= addLink('basket','addToBasket') ?>">
                    <i class="fa-sharp fa-solid fa-cart-shopping" id="basket-icon"></i>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
    </section>

    <script>
        const productsData = <?php echo json_encode($_SESSION['basket'] ?? []); ?>;
    </script>

</section>
