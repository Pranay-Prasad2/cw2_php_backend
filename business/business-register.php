<?php
// session_start();
include("../db.php");
include("../navbar.php");

$fetch_area_query = "SELECT * FROM area";

$area_list = mysqli_query($conn, $fetch_area_query);
?>

<div class="d-flex justify-content-center align-items-center mt-3">
    <div class="w-25 card shadow p-4">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Business Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Business description</label>
                 <textarea name="desc" id="desc" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="upassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="upassword" id="upassword">
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Select Your area</label>
                <select name="area_id" id="area_id" class="form-control">
                    <option value="">Select area</option>
                    <?php
                    while ($area_row = mysqli_fetch_assoc($area_list)) {
                        echo "<option value='" . $area_row['area_id'] . "'>" . $area_row['area_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" />
        </form>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_SPECIAL_CHARS);
    $userEMAIL = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $userpassword = filter_input(INPUT_POST, "upassword", FILTER_SANITIZE_SPECIAL_CHARS);
    $areaId = $_POST["area_id"];

    $register_user_querry = "INSERT INTO business(business_name,business_desc,business_email,business_password,area_id) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $register_user_querry);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $username,$description, $userEMAIL, $userpassword, $areaId);
        if (mysqli_stmt_execute($stmt)) {
            // echo "Business registered";
            header("Location: business-login.php");
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }
}
?>