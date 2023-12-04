<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="./js/dropdown.js"></script>
<style>
    .container{
        background-image: url("pic/agriculture.jpg");
        
    }
    
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container" >
    <div class="left-container">
        <p>
            <h2>Join us today!</h2>
        </p>
        <p>Sign up now to become a member</p>
        <form>
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="text" id="phoneNum" name="phoneNum" placeholder="Phone Number">
            <input type="text" id="Email" name="Email" placeholder="Email">
            <input type="text" id="password" name="password" placeholder="Password">
            <input type="text" id="comPassword" name="comPassword" placeholder="Comfirm Password">
        </form>
        <button class="signup-btn" id="login" value="Sign Up">Sign Up</button>
        <p>Already have an account? <a href="login.php"><b>Login</b></a></p>
 
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
