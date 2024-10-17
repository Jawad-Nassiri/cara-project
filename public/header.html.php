<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>E-commerce Website</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="http://localhost/project%20final%20de%20poles/public/assets/css/style.css">

    <!-- Custom JS -->
    <script src="http://localhost/project%20final%20de%20poles/public/assets/js/script.js" defer ></script>

</head>
<body>



<section id="header">
        <a href="http://localhost/project%20final%20de%20poles"><img src="/project%20final%20de%20poles/public/assets/images/logo.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="http://localhost/project%20final%20de%20poles">Home</a></li>
                <li><a href="/project%20final%20de%20poles/product/shop">Shop</a></li>
                <li><a href="/project%20final%20de%20poles/product/blog">Blog</a></li>
                <li><a href="/project%20final%20de%20poles/product/about">About</a></li>
                <li><a href="/project%20final%20de%20poles/contact/submitContactForm">Contact</a></li>
                <li><a href="/project%20final%20de%20poles/Sign_In/signIn">Sign In</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                <li><a href="/project%20final%20de%20poles/logout.php" class="logout">Logout</a></li>
                <?php else: ?>
                <li><a href="/project%20final%20de%20poles/Sign_Up/submitSign_UpForm" class="login">Sign Up</a></li>
                <?php endif; ?>
                <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark" id="xmark"></i></a>
                <li id="user"><i class="fa-solid fa-user"></i><?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>




























