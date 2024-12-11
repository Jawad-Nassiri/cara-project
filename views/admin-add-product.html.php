<div class="list">
    <a href="#product-list">Product List</a>
    <a href="#user-list">User List</a>
</div>

<form method="post" action="<?= addLink('AdminAddProduct','addProduct') ?>" enctype="multipart/form-data" class="product-form">
    <div class="form-group">
    <h1 class="all-product">Add New Product</h1>
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

    <div class="form-group" id="product-list">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" id="stock" name="stock" class="form-input" required>
    </div>

    <button type="submit" class="form-submit" name="submit">Add Product</button>
</form>


<!-- All Products list  -->

<?php if (isset($products) && count($products) > 0): ?>
    <h1 class="all-product">All Products</h1>
    <div class="table-wrapper admin-product-table">
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

    



<!-- Add user account form  -->

<form method="post" action="<?= addLink('AdminAddProduct','editUserAccount') ?>" class="user-form">
        <div class="input-group">
            <h1 class="all-product">Create User Account</h1>
            <label for="username" class="input-label">Username:</label>
            <input type="text" id="username" name="username" class="input-field" required>
        </div>
    
        <div class="input-group">
            <label for="email" class="input-label">Email:</label>
            <input type="email" id="email" name="email" class="input-field" required>
        </div>
    
        <div class="input-group">
            <label for="password" class="input-label">Password:</label>
            <input type="password" id="password" name="password" class="input-field" required>
        </div>
    
        <div class="input-group" id="user-list">
            <label for="statut_admin" class="input-label">Admin Status:</label>
            <select id="statut_admin" name="statut_admin" class="input-select">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
    
        <button type="submit" class="submit-btn" name="submit">Add User</button>
    </form>



<!-- All users list  -->
<?php if (isset($users) && count($users) > 0): ?>
    <h1 class="all-users">All Users</h1>
    <div class="table-wrapper admin-user-table">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo $user['statut_admin'] ? 'Admin' : 'User'; ?></td>
                        <td>
                            <button class="edit-user-btn" data-id="<?= $user['id']; ?>">Edit</button>
                            <button class="delete-user-btn" data-id="<?= $user['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No users available.</p>
<?php endif; ?>
