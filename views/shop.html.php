<section id="page-header">
    <h2>#Stay-home</h2>
    <p>Save more with coupons & up to 70% off!</p>
</section>

<section id="product1" class="section-p1">
    <div class="pro-container">
        <?php foreach ($products as $product): ?>
            <div class="pro" onclick="window.location.href='details-page.html.php';">
            <img src="../public/assets/images/products/<?php echo htmlspecialchars($product->getPhoto()); ?>" alt="<?php echo htmlspecialchars($product->getTitre());?>">
                <div class="des">
                    <span><?= htmlspecialchars($product->getMarque()) ?></span>
                    <h5><?= htmlspecialchars($product->getTitre()) ?></h5>
                    <div class="star">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h4><?= htmlspecialchars($product->getPrix()) ?>€</h4>
                </div>
                <a href="#"><i class="fa-sharp fa-solid fa-cart-shopping" id="icon"></i></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="pagination" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <h2 class="title">Shop the Latest Styles – Fashion at Your Fingertips</h2>
    <p>At CARA we believe that fashion is more than just clothing – it's a way to express yourself.</p>
    <a class="shop" href="#">Shop</a>
</section>
