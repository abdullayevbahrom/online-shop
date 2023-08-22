<?php
$page = $_SESSION["page"];
?>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="#">
                    <h1 class="tm-site-title mb-0"><?= $page ?></h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <?php if ($_SESSION["user"]["role"] === ADMIN) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $page === "Brands" ? "active" : null; ?>" href="/brands/action/index">
                                    <i class="fas fa-warehouse"></i>
                                    Brands
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $page === "Categories" ? "active" : null; ?>" href="/categories/action/index">
                                    <i class="fas fa-bars"></i>
                                    Categories
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $page === "Products" ? "active" : null; ?>" href="/products/action/index">
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page === "Orders" ? "active" : null; ?>" href="/orders/action/index">
                                <i class="fas fa-file-alt"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $page === "Users" ? "active" : null; ?>" href="/users/action/index">
                                <i class="far fa-user"></i>
                                Accounts
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form action="/auth/logout" method="post">
                                <button class="btn btn-warning rounded"><b>Logout</b></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>