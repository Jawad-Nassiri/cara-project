<form method="post" enctype="multipart/form-data" class="product-form">
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
    