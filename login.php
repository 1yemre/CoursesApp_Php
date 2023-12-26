<?php
require "libs/variables.php";
require "libs/functions.php";
include "libs/Ayar.php";

session_start();

if (isloggedIn()) {
    header("location: index.php");
}

$usernameErr = $repasswordErr = "";
$username = $repassword = $LoginErr = "";

if (isset($_POST["login"])) {
    if (empty($_POST["username"])) {
        $usernameErr = "Kullanıcı adı gerekli alan.";
    } else {
        $username = safe_html($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $repasswordErr = "Parola gerekli alan.";
    } else {
        $repassword = safe_html($_POST["password"]);
    }

    if (empty($usernameErr) && empty($repasswordErr)) {
        $sql = "SELECT id,username,password,users_type FROM users  WHERE username=?";

        if ($stmt = mysqli_prepare($baglanti, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $users_type);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($repassword, $hashed_password)) {
                            $_SESSION["loggedIn"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["users_type"] = $users_type;

                            header("Location: index.php");
                        } else {
                            $LoginErr = "Parola Yanlış";
                        }
                    }
                } else {
                    $LoginErr = "Username Hatalı";
                }
            } else {
                $LoginErr = "Hata!";
            }
        }
    }
}

?>

<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<?php if (!empty($LoginErr)) {
    echo "<div class='alert alert-danger'>" . $LoginErr . "</div>";
} ?>

<div class="container my-3">

    <div class="row">
        <div class="col-12">
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <div class="text-danger"><?php echo $usernameErr; ?></div>
                </div>
                <div class="mb-3">
                    <label for="password">Parola</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $repassword; ?>">
                    <div class="text-danger"><?php echo $repasswordErr; ?></div>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>

</div>
<?php include "partials/_footer.php" ?>
