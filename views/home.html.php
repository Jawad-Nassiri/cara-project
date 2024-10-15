<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more with coupons & up to 70% off!</p>
    <button>Shop Now</button>
</section>

<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="/project%20final%20de%20poles/public/assets/images/features/f1.png" alt="Feature">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
        <img src="/project%20final%20de%20poles/public/assets/images/features/f2.png" alt="Feature">
        <h6>Online Order</h6>
    </div>
    <div class="fe-box">
        <img src="/project%20final%20de%20poles/public/assets/images/features/f3.png" alt="Feature">
        <h6>Save Money</h6>
    </div>
    <div class="fe-box">
        <img src="/project%20final%20de%20poles/public/assets/images/features/f4.png" alt="Feature">
        <h6>Promotions</h6>
    </div>
    <div class="fe-box">
        <img src="/project%20final%20de%20poles/public/assets/images/features/f5.png" alt="Feature">
        <h6>Happy Sell</h6>
    </div>
    <div class="fe-box">
        <img src="/project%20final%20de%20poles/public/assets/images/features/f6.png" alt="Feature">
        <h6>24/7 Support</h6>
    </div>
</section>

<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Model Design</p>
    <div class="pro-container">
        <?php if (!empty($products)): ?>
            <?php $productCount = count($products); ?>
            <?php for ($i = 0; $i < min(8, $productCount); $i++): ?>
                <?php $product = $products[$i]; ?>
                <div class="pro">
                    <img src="public/assets/images/products/<?php echo htmlspecialchars($product->getPhoto()); ?>" alt="<?php echo htmlspecialchars($product->getTitre());?>">
                    <div class="des">
                        <span><?php echo htmlspecialchars($product->getMarque()); ?></span>
                        <h5><?php echo htmlspecialchars($product->getTitre()); ?></h5> 
                        <div class="star">
                            <?php for ($j = 0; $j < 5; $j++): ?>
                                <i class="fas fa-star"></i> 
                            <?php endfor; ?>
                        </div>
                        <h4><?php echo htmlspecialchars(number_format($product->getPrix(), 2)); ?>€</h4>
                    </div>
                    <a href="#"><i class="fa-sharp fa-solid fa-cart-shopping" id="icon"></i></a>
                </div>
            <?php endfor; ?>
        </div>
</section>

        <section id="banner" class="section-m1">
            <h4>Repair Service</h4>
            <h2>Up to <span>70% Off</span> - All t-Shirts & Accessories</h2>
            <button class="normal">Explore More</button>
        </section>

<section id="product1" class="section-p1">

        <div class="pro-container">
            <?php for ($i = 8; $i < min(16, $productCount); $i++): ?>
                <?php $product = $products[$i]; ?>
                <div class="pro">
                    <img src="public/assets/images/products/<?php echo htmlspecialchars($product->getPhoto()); ?>" alt="<?php echo htmlspecialchars($product->getTitre());?>">
                    <div class="des">
                        <span><?php echo htmlspecialchars($product->getMarque()); ?></span>
                        <h5><?php echo htmlspecialchars($product->getTitre()); ?></h5> 
                        <div class="star">
                            <?php for ($j = 0; $j < 5; $j++): ?>
                                <i class="fas fa-star"></i> 
                            <?php endfor; ?>
                        </div>
                        <h4><?php echo htmlspecialchars(number_format($product->getPrix(), 2)); ?>€</h4>
                    </div>
                    <a href="#"><i class="fa-sharp fa-solid fa-cart-shopping" id="icon"></i></a>
                </div>
            <?php endfor; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</section>


<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletters</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign Up</button>
    </div>
</section>
