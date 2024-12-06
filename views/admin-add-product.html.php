<form method="post" action="<?= addLink('AdminAddProduct','addProduct') ?>" enctype="multipart/form-data" class="product-form">
    <div class="form-group">
        <label for="categorie" class="form-label">Category:</label>
        <input type="text" id="categorie" name="categorie" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="titre" class="form-label">Title:</label>
        <input type="text" id="titre" name="titre" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="marque" class="form-label">Brand:</label>
        <input type="text" id="marque" name="marque" class="form-input" required>
    </div>

    <div class="form-group">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="description" rows="5" class="form-textarea" required></textarea>
    </div>

    <div class="form-group">
        <label for="public" class="form-label">Public:</label>
        <select id="public" name="public" class="form-select">
            <option value="m">Male</option>
            <option value="f">Female</option>
            <option value="mixte">Unisex</option>
        </select>
    </div>

    <div class="form-group">
        <label for="photo" class="form-label">Photo:</label>
        <input type="file" id="photo" name="photo" class="form-input" accept="image/*" required>
    </div>

    <div class="form-group">
        <label for="prix" class="form-label">Price:</label>
        <input type="number" id="prix" name="prix" class="form-input" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" id="stock" name="stock" class="form-input" required>
    </div>

    <button type="submit" class="form-submit" name="submit">Add Product</button>

</form>


<!-- All Products list  -->

<?php if (isset($products) && count($products) > 0): ?>
    <div class="table-wrapper admin-product-table">
        <h1 class="all-product">All Products</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product->getTitre()); ?></td>
                        <td><?php echo htmlspecialchars($product->getCategorie()); ?></td>
                        <td><?php echo htmlspecialchars($product->getMarque()); ?></td>
                        <td><?php echo number_format($product->getPrix(), 2); ?> €</td>
                        <td><?php echo $product->getStock(); ?></td>
                        <td>
                            <?php if ($product->getPhoto()): ?>
                                <img src="/project%20final%20de%20poles/public/assets/images/products/<?php echo htmlspecialchars($product->getPhoto()); ?>" alt="Product Image" width="50" height="50">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="edit-btn" data-id="<?= $product->getId(); ?>">Edit</button>
                            <button class="delete-btn" data-id="<?= $product->getId(); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No products available.</p>
<?php endif; ?>

    




<!-- All users list  -->