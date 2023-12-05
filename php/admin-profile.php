<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/dropdown.js"></script>
    <style>
        body{
            background-color: #A9B7FF;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="left-shadow">
    <div class="left-container">
        <br>
        <img src="../icon/user.png">
        <br>
        <br>
        <p>
        Username:
        </p>
    
</div>
</div>
<div class="right-shadow">
<div class="right-container">
<br>
<p>Edit Profile</p>
    <ul>
        <li>Phone Number</li>
        <li>Email Address</li>
        <li>Password</li>
    </ul>
    <ul>
        <form>
        <li> <input type="text" id="phoneNum" name="phoneNum" ></li>
        <li> <input type="text" id="email" name="email"></li>
        <li> <input type="text" id="password" name="password"></li>
        </form>
    </ul>
    <ul>
        <li>Comfirm Phone Number</li>
        <li>Comfirm Email Address</li>
        <li>Comfirm Password</li>
    </ul>
        <form>
           <li> <input type="text" id="comPhoneNum" name="comPhoneNum" ></li>
           <li> <input type="text" id="comEmail" name="comEmail"></li>
           <li> <input type="text" id="comPassword" name="comPassword"></li>
        </form>
        <button class="updateInfo-btn" id="updateInfo" value="updateInfo">Update Info</button>
 
</div>
</div>
</div>


</body>
<?php include 'footer.php'; ?>


</html>
