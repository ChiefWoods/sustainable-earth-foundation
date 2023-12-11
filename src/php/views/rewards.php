<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rewards | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/rewards.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
</head>

<body>
  <?php include '../components/header.php'; ?>
  <main>
    <section>
      <div>
        <div id="head">
          <img src="../../assets/icons/reward/reward.svg" alt="Reward" id="reward-icon">
          <div id="title">
            <h2>Reward Redemption</h2>
            <button id="help-btn">
              <img src="../../assets/icons/help_circle_outline/help_circle_outline.svg" alt="Help" id="help-icon">
            </button>
          </div>
          <p id="desc">Redeeming your hard earned points is easy!<br>Choose a voucher code below.</p>
        </div>
        <div id="saved-points">
          <span>Saved Points</span>
          <span id="user-points">4567 points</span>
        </div>
      </div>
      <ul>
        <li>
          <div>
            <h3 class="name">$5.00 OFF</h3>
            <p class="points">500 points</p>
          </div>
          <button class="btn redeem-btn">Redeem</button>
        </li>
        <li>
          <div>
            <h3 class="name">$10.00 OFF</h3>
            <p class="points">900 points</p>
          </div>
          <button class="btn redeem-btn">Redeem</button>
        </li>
        <li>
          <div>
            <h3 class="name">$15.00 OFF</h3>
            <p class="points">1300 points</p>
          </div>
          <button class="btn redeem-btn">Redeem</button>
        </li>
        <li>
          <div>
            <h3 class="name">$20.00 OFF</h3>
            <p class="points">1700 points</p>
          </div>
          <button class="btn redeem-btn">Redeem</button>
        </li>
      </ul>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>
</body>

</html>