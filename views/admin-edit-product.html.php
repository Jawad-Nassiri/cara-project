<form method="post" action="<?= addLink('AdminAddProduct', 'editProduct', $product->getId()) ?>" enctype="multipart/form-data" class="product-form">
    <div class="form-group">
        <label for="categorie" class="form-label">Category:</label>
        <input type="text" id="categorie" name="categorie" class="form-input" value="<?= htmlspecialchars($product->getCategorie() ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="titre" class="form-label">Title:</label>
        <input type="text" id="titre" name="titre" class="form-input" value="<?= htmlspecialchars($product->getTitre() ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="marque" class="form-label">Brand:</label>
        <input type="text" id="marque" name="marque" class="form-input" value="<?= htmlspecialchars($product->getMarque() ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="description" rows="5" class="form-textarea" required><?= htmlspecialchars($product->getDescription() ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="public" class="form-label">Public:</label>
        <select id="public" name="public" class="form-select">
            <option value="m" <?= $product->getPublic() == 'm' ? 'selected' : '' ?>>Male</option>
            <option value="f" <?= $product->getPublic() == 'f' ? 'selected' : '' ?>>Female</option>
            <option value="mixte" <?= $product->getPublic() == 'mixte' ? 'selected' : '' ?>>Unisex</option>
        </select>
    </div>

    <div class="form-group">
        <label for="photo" class="form-label">Photo:</label>
        <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
    </div>

    <div class="form-group">
        <label for="prix" class="form-label">Price:</label>
        <input type="number" id="prix" name="prix" class="form-input" step="0.01" value="<?= htmlspecialchars($product->getPrix() ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" id="stock" name="stock" class="form-input" value="<?= htmlspecialchars($product->getStock() ?? '') ?>" required>
    </div>

    <button type="submit" class="form-submit" name="submit">Save Changes</button>
</form>
