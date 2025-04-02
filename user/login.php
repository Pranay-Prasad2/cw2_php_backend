<?php
session_start();
include("../db.php");
include("../navbar.php");
?>

<div class="d-flex flex-column justify-content-center align-items-center mt-5">
    <div class="w-25 card shadow p-4">
        <h2>User Login</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="upassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="upassword" id="upassword">
            </div>
            <input type="submit" value="Login" class="btn btn-success" />
            <?php echo '<a href="register.php" class="btn btn-secondary">Register</a>'; ?>
        </form>
    </div>
    <?php echo '<a href="/healthify/business/business-login.php" class="mt-5"> Login as Business </a>'; ?>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $useremail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $userpassword = filter_input(INPUT_POST, "upassword", FILTER_SANITIZE_SPECIAL_CHARS);

    // SELECT * FROM `user` WHERE user_email = "pranay@gmail.com" AND user_password = "123456";
    $login_querry = "SELECT * FROM user WHERE user_email = '$useremail' AND user_password = '$userpassword'";
    $result = $conn->query($login_querry);


    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['user_name'];
        $_SESSION['role'] = 'user';
        header("Location: ../index.php");
    } else {
        echo "Login Error";
    }
}

?>