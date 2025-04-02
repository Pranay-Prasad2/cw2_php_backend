<?php
    session_start();
    include("../db.php");
    include("../navbar.php");
?>

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="w-25 card shadow p-4">
        <h2>Business Login</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="upassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="upassword" id="upassword">
            </div>
            <input type="submit" value="Login" class = "btn btn-primary" />
            <?php echo '<a href="business-register.php" class="btn btn-primary">Register</a>'; ?>
        </form>
        
    </div>
</div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $useremail = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
    $userpassword = filter_input(INPUT_POST,"upassword",FILTER_SANITIZE_SPECIAL_CHARS);

    // SELECT * FROM `user` WHERE user_email = "pranay@gmail.com" AND user_password = "123456";
    $login_querry = "SELECT * FROM business WHERE business_email = '$useremail' AND business_password = '$userpassword'";
    $result = $conn->query($login_querry);


    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['business_name'];
        $_SESSION['role'] = 'business';
        $_SESSION['b_id'] = $row['business_id'];
        header("Location: dashboard.php");
    } else {
        echo "Login Error";
    }
}

?>