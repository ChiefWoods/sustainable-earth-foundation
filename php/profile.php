<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/dropdown.js"></script>
</head>
<body>

<?php include 'header.php'; ?>
<div class="container">
    <div class="left-shadow">
    <div class="left-container">
        <img src="../icon/user.png">
        <br>
        <p>
          Username:
        </p>
        <p>Earned Points:</P>
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
<div class="bottom-container">
    <table>
        <tr>
            <th></th>
            <th>Redeem History</th>
            <th></th>
        </tr>    
        <tr>
            <td>Voucher Code</td>
            <td>Used Points</td>
            <td>Redeemption Date</td>
        </tr>    
 
    </table>
    <div class="tip">
        <p> <img src="../icon/bulb.png" width="30px" height="30px" style="vertical-align:middle;"> Tips for earning more points! <img src="../icon/bulb.png" width="30px" height="30px" style="vertical-align:middle;"></p> 
        <img src="../icon/star.png" style="float:left; width:30px; height:30px; padding-left: 50px;" >
        <p style="text-align:left; padding-right: 40px;">Write posts on environment issues, rural areas, urban planning, etc. that are inline with SDG11's objectives, share them on the sticky wall, and earn points for every upvote you receive!</p>
    </div>
</div>
</body>
<?php include 'footer.php'; ?>


</html>
