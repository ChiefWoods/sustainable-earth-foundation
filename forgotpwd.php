<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="./js/dropdown.js"></script>
<style>
    .container{
        background-image: url("pic/forgot.jpg");
        
    }
    .left-container input[type=text]{
        padding-bottom: 25px;
    }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container" >
    <div class="left-container" style="float: right;">
        <br>
        <br>
        <br>
        <p><h2>Forgot Password</h2></p>
        <br>
        <form>
            <input type="text" id="oldpassword" name="oldpassword" placeholder="Old Password">
            
            <input type="text" id="newpassword" name="newpassword" placeholder="New Password">
            <input type="text" id="comNewpassword" name="comNewpassword" placeholder="Comfirm New Password">

        </form>
        <br>
       
        <button class="update-btn" id="update" value="Update">Update</button>
        <p>Click here to <a href="login.php"><b>Login</b></a></p>
 
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
