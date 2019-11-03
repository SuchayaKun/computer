<?php require_once('../Connections/computer.php'); ?>
<?php include("dw-upload.php"); ?>
<?php 

    session_start();

    require_once "connection.php";

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $user_check = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if ($user['username'] === $username) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $passwordenc = md5($password);

            $query = "INSERT INTO user (username, password, firstname, lastname, userlevel)
                        VALUE ('$username', '$passwordenc', '$firstname', '$lastname', 'm')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['success'] = "Insert user successfully";
                header("Location: index.php");
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: index.php");
            }
        }

    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("h6").click(function(){
    alert("สมัครสมาชิกสำเร็จ");
  });
});
</script>

</head>
<body>

<div class="limiter">
<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
<div class="wrap-login100">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
<span class="login100-form-logo">
	<i class="zmdi zmdi-landscape"></i>
  </span>
		<span class="login100-form-title p-b-34 p-t-27">
	Register
</span>
	
	
        <div class="wrap-input100 validate-input" data-validate = "Enter username">
        <input class="input100" type="text" name="username" placeholder="ชื่อผู้ใช้" required>
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
		</div>
	
         <div class="wrap-input100 validate-input" data-validate="Enter password">
        <input class="input100" type="password" name="password" placeholder="รหัสผ่าน" required>
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
		</div>
	
         <div class="wrap-input100 validate-input" data-validate="Enter password">
        <input class="input100" type="text" name="firstname" placeholder="ชื่อจริง" required>
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
		</div>
	
         <div class="wrap-input100 validate-input" data-validate="Enter password">
        <input class="input100" type="text" name="lastname" placeholder="นามสกุล" required>
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
		</div>
	
  <div class="container-login100-form-btn">
  <button class="login100-form-btn">    
	<h6><input  type="submit" name="submit" value="Submit"><h6>
  </button>
  </div
    
    ><div class="text-center p-t-90">
	<a class="txt1" href="index.php">
		cancel
	</a>
	</div>

    
  </form>
</div>
</div>
</div>
</body>
</html>