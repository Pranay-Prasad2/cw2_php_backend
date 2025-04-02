<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('db.php');
// echo $_SESSION['name']

?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/healthify/index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/healthify/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/healthify/product.php">Products</a>
                </li>
                <?php

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'business') {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="/healthify/business/dashboard.php">Dashboard</a>
                    </li>';
                }

                if (isset($_SESSION['user'])) {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="/healthify/logout.php">Logout</a>
                    </li>';
                } else {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="/healthify/user/login.php">Login</a>
                        </li>';
                }

                ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/healthify/business/business-register.php">Register Business</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>