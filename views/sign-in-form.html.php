<div class="form-container-main">
        <div class="form-inner-container">

            <div class="left-section">

                <h2 class="form-title">Sign In</h2>

                <form method="post">
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div>

                    <?php if (isset($errors['username'])): ?>
                        <p class="sign-in-error"><?= htmlspecialchars($errors['username']) ?></p>
                    <?php endif; ?>
        
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>

                    <?php if (isset($errors['password'])): ?>
                        <p class="sign-in-error"><?= htmlspecialchars($errors['password']) ?></p>
                    <?php endif; ?>

                    <input type="submit" value="Sign In" class="button">

                    <p class="social-media">Or sign up with a social platform</p>

                    <div class="social-media-platforms">
                        <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-square-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </form>
            </div>

            <div class="right-section">

                <h3 class="form-title">New to Brand?</h3>
                <pre>
If you're a new member,
you can sign up using the button below.
                </pre>

                <a href="http://localhost/project%20final%20de%20poles/Sign_Up/sign_UpForm" class="button signup">Sign Up</a>

                <img src="/project%20final%20de%20poles/public/assets/images/forms/sign-in-form.svg" alt="welcome" class="form-image">
            </div>
        
        </div>
</div>