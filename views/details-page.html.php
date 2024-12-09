

    <style>
        #prodetails {
            display: flex;
            justify-content: space-between; 
            margin-top: 20px;
            flex-wrap: wrap; 
        }

        #prodetails .single-pro-image {
            width: 40%;
            margin-right: 20px; 
        }

        #prodetails .single-pro-image img {
            width: 100%; 
            height: auto;
        }

        #prodetails .single-pro-details {
            width: 55%;
            padding-top: 30px;
        }

        #prodetails .single-pro-details h6 {
            font-size: 16px;
            color: #777;
        }

        #prodetails .single-pro-details h4 {
            font-size: 26px;
            padding: 20px 0;
        }

        #prodetails .single-pro-details h2 {
            font-size: 32px;
            color: #088178;
        }

        #prodetails .single-pro-details select {
            padding: 6px 12px;
            margin-bottom: 10px;
            width: 150px;
            display: block;
            border: 1px solid #ccc;
            font-size: 14px; 
        }

        #prodetails .single-pro-details select:focus {
            outline: none;
            border-color: #088178; 
        }

        #prodetails .single-pro-details input {
            width: 50px;
            height: 47px;
            padding-left: 10px;
            font-size: 16px;
            margin-right: 10px;
            border: 1px solid #ccc;
        }

        #prodetails .single-pro-details input:focus {
            outline: none;
            border-color: #088178;
        }

        #prodetails .single-pro-details button {
            background: #088178;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            height: 47px;
        }

        #prodetails .single-pro-details button:hover {
            background-color: #064d4d;
        }

        #prodetails .single-pro-details span {
            line-height: 25px;
            color: #555;
        }

        @media (min-width: 1024px) and (max-width: 1400px) {
            #prodetails .single-pro-image {
                width: 50%;
            }

            #prodetails .single-pro-details {
                width: 45%;
            }
        }

        @media (max-width: 1024px) {
            #prodetails {
                flex-direction: column;
                align-items: center;
            }

            #prodetails .single-pro-image,
            #prodetails .single-pro-details {
                width: 90%; 
                margin-right: 0; 
                margin-bottom: 20px;
            }

            #prodetails .single-pro-image {
                width: 90%;
            }

            #prodetails .single-pro-details {
                width: 90%; 
            }
        }

        @media (max-width: 768px) {
            #prodetails {
                flex-direction: column;
                align-items: center;
            }

            #prodetails .single-pro-image,
            #prodetails .single-pro-details {
                width: 90%; 
                margin-right: 0; 
                margin-bottom: 20px;
            }

            #prodetails .single-pro-image {
                width: 90%;
            }

            #prodetails .single-pro-details {
                width: 90%; 
            }
        }

    </style>

<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="/project%20final%20de%20poles/public/assets/images/products/<?= htmlspecialchars($product->getPhoto()); ?>" id="main-image" alt="t-shirt">
    </div>
    
    <div class="single-pro-details">
        <h6>Shop / <?= htmlspecialchars($product->getCategorie()); ?></h6>
        <h4><?= htmlspecialchars($product->getTitre()); ?></h4>
        <h2><?= htmlspecialchars($product->getPrix()); ?>€</h2>

        <select id="product-size">
            <option value="small" selected>Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
            <option value="x-large">X-Large</option>
        </select>

        <input type="number" value="1">
        <button class="normal" data-product-id="<?= $product->getId() ?>" data-url = "<?= addLink('basket','addToBasket') ?>">Add to cart</button>
        <h4>Product details</h4>
        <span><?= htmlspecialchars($product->getDescription()); ?></span>
    </div>
</section>
