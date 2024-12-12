
<form method="post" class="user-form">
    <div class="input-group">
        <h1 class="all-product">Edit User Account</h1>
        
        <label for="username" class="input-label">Username:</label>
        <input type="text" id="username" name="username" class="input-field" value="<?php echo htmlspecialchars($user['username']); ?>" required>
    </div>

    <div class="input-group">
        <label for="email" class="input-label">Email:</label>
        <input type="email" id="email" name="email" class="input-field" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>

    <div class="input-group">
        <label for="password" class="input-label">Password:</label>
        <input type="password" id="password" name="password" class="input-field" value="<?php echo htmlspecialchars($user['password']); ?>" disabled>
    </div>

    <div class="input-group" id="user-list">
        <label for="statut_admin" class="input-label">Admin Status:</label>
        <select id="statut_admin" name="statut_admin" class="input-select">
            <option value="0" <?php echo ($user['statut_admin'] == 0) ? 'selected' : ''; ?>>No</option>
            <option value="1" <?php echo ($user['statut_admin'] == 1) ? 'selected' : ''; ?>>Yes</option>
        </select>
    </div>

    <button type="submit" class="submit-btn" name="submit">Update User</button>
</form>
