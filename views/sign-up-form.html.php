<div class="signup-container">
    <div class="signup-form-container">

        <div class="signup-left-panel">
            <h3 class="signup-title">Member of Brand ?</h3>
            <pre>
                If you're already a member,
                you can sign in using the button below.
            </pre>
            <a href="http://localhost/project%20final%20de%20poles/Sign_In/signIn" class="login-btn signup-btn">Sign In</a>
            <img src="/project%20final%20de%20poles/public/assets/images/forms/sign-up-form.svg" alt="welcome" class="signup-image">
        </div>

        <div class="signup-right-panel">
            <h2 class="signup-title">Sign Up</h2>

            <form method="post" class="singUp-form">
                <div class="signup-input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="username-input" placeholder="Username" name="username" autocomplete="off">
                </div>
                <span class="username-error-message"></span>
                <?php if (!empty($errors['username'])): ?>
                    <span><?= htmlspecialchars($errors['username']) ?></span>
                <?php endif; ?>

                <div class="signup-input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="password-input" placeholder="Password" name="password" autocomplete="off">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
                <span class="password-error-message"></span>
                <?php if (!empty($errors['password'])): ?>
                    <span><?= htmlspecialchars($errors['password']) ?></span>
                <?php endif; ?>
                
                <div class="signup-input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" class="email-input" placeholder="Email" name="email" autocomplete="off">
                </div>
                <span class="email-error-message"></span>
                <?php if (!empty($errors['email'])): ?>
                    <span><?= htmlspecialchars($errors['email']) ?></span>
                <?php endif; ?>

                <input type="submit" value="Sign Up" class="signup-btn">

                <p class="signup-social-media">Or sign up with social platform</p>

                <div class="signup-social-platforms">
                    <a href="" class="signup-social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="" class="signup-social-icon"><i class="fa-brands fa-twitter"></i></a>
                    <a href="" class="signup-social-icon"><i class="fa-brands fa-square-instagram"></i></a>
                    <a href="" class="signup-social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>

            </form>
        </div>

    </div>
</div>
