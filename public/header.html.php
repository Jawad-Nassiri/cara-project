<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce Website</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="http://localhost/project%20final%20de%20poles/public/assets/css/style.css">
    <!-- <link rel="stylesheet" href="/project%20final%20de%20poles/public/assets/css/style.css"> -->

</head>

<body>



    <section id="header">
        <a href="http://localhost/project%20final%20de%20poles"><img src="/project%20final%20de%20poles/public/assets/images/logo.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="mouse-over" href="http://localhost/project%20final%20de%20poles/product/index">Home</a></li>

                <li><a class="mouse-over" href="/project%20final%20de%20poles/product/shop">Shop</a></li>

                <li><a class="mouse-over" href="/project%20final%20de%20poles/product/blog">Blog</a></li>

                <li><a class="mouse-over" href="/project%20final%20de%20poles/product/about">About</a></li>

                <li><a class="mouse-over" href="/project%20final%20de%20poles/contact/submitContactForm">Contact</a></li>


                <?php if (isset($_SESSION['statut_admin']) && $_SESSION['statut_admin'] == 1): ?>
                    <li><a class="mouse-over" href="/project%20final%20de%20poles/AdminAddProduct/showAddProductForm">Admin Dashboard</a></li>
                <?php endif; ?>


                <?php if (isset($_SESSION['username'])): ?>
                    <li><a class="mouse-over" href="/project%20final%20de%20poles/sign_In/logout" class="logout">Logout</a></li>
                <?php else: ?>
                    <li><a class="mouse-over" href="/project%20final%20de%20poles/Sign_In/signIn">Sign In</a></li>
                    <li><a class="mouse-over" href="/project%20final%20de%20poles/Sign_Up/sign_UpForm" class="login">Sign Up</a></li>
                <?php endif; ?>


                <li id="lg-bag"><a class="mouse-over" href="/project%20final%20de%20poles/Basket/basket" data-count="<?= isset($_SESSION['basket_count']) ? $_SESSION['basket_count'] : 0  ?>"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark" id="xmark"></i></a>


                <li id="user">
                    <i class="fa-solid fa-user"></i>
                    <?php if (isset($_SESSION['username'])): ?>
                        <?= htmlspecialchars($_SESSION['username']) ?>
                        <?php if (isset($_SESSION['statut_admin']) && $_SESSION['statut_admin'] == 1): ?>
                            (Admin)
                        <?php endif; ?>
                    <?php endif; ?>
                </li>

            </ul>
        </div>
        <div id="mobile">
            <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>