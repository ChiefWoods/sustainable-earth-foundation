<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="./js/dropdown.js"></script>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="left-container">
        <img src="icon/user.png">
        <p>
            <h2>Welcome back!</h2>
        </p>
        <form>
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="text" id="password" name="password" placeholder="Password">
        </form>
        <button class="login-btn" id="login" value="Login">Login</button>
        <p>Forgot password? <a href=""><b>Click here</b></a></p>
        <div class="signup">
            <p>Don't have an account? <a href=""><b>Sign Up</b></a></p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
