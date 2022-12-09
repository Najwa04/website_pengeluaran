<?php

include '../algoritme/koneksi.php';

error_reporting(0);

session_start();

// if (isset($_SESSION['email'])) {
//     header("Location: ../login/dashboard.php");
// }

if (isset($_POST['submit'])) {
    $email = ($_POST['admin_email']);
    $password = md5($_POST['admin_password']);

    $sql = "SELECT * FROM admin_table WHERE admin_email='$email' AND admin_password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['email'] = $row['admin_email'];
        header("Location: .dashboard.php");
    } else {
        echo "<script>alert('Email Anda salah. Silahkan coba lagi!')</script>";
    }
}else{
}

?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="../pages/CSS/login.css">
 
    <title>Etalase Talisya Admin Shop</title>
</head>
<body>
<?php
            if($err){
            ?>
            <div class="alert alert-danger">
                <?php echo $err ?>
            </div>
            <?php    
            }
            ?>
 
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login Admin</p>
            <div class="input-group">
                <input type="email" placeholder="Masukkan Email Anda" name="admin_email" value="<?php echo $_POST['admin_email']; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Masukkan Password Anda" name="admin_password" value="<?php echo $_POST['admin_password']; ?>" required>
            </div>
            <div class="input-group">
                <a href=".dashboard.php"><button name="submit" class="btn">Login</button></a>
            <!-- </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p> -->
        </form>
    </div>
</body>
</html>