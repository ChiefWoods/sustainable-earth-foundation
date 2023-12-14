const overlay = document.querySelector('.overlay');
const helpDialog = document.querySelector('#help-dialog');
const redeemDialog = document.querySelector('#redeem-dialog');
const helpBtn = document.querySelector('#help-btn');
const cancelBtn = document.querySelector('#cancel-btn');
const yesBtn = document.querySelector('#yes-btn');
const closeBtns = document.querySelectorAll('.close-btn');
const redeemBtns = document.querySelectorAll('.redeem-btn');
const userPointsSpan = document.querySelector('#user-points');

let currentReward = null;

function toggleOverlay() {
  overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

function redeemReward(rewardName, rewardPoints) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        userPointsSpan.textContent = data.userPoints;
        window.location.reload();
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'redeem',
    reward_name: rewardName,
    reward_points: rewardPoints,
  });

  xhr.send(formData);
}

function handleYesBtn() {
  if (currentReward) {
    const rewardName = currentReward.querySelector('.reward-name').textContent;
    const rewardPoints = parseInt(currentReward.querySelector('.reward-points').textContent.split(' ')[0]);

    redeemReward(rewardName, rewardPoints);
    redeemDialog.close();
    toggleOverlay();
    currentReward = null;
  }
}

helpBtn.addEventListener('click', () => {
  helpDialog.showModal();
  toggleOverlay();
});

redeemBtns.forEach((btn) => {
  btn.addEventListener('click', (e) => {
    currentReward = e.target.parentElement;
    redeemDialog.showModal();
    toggleOverlay();
    yesBtn.addEventListener('click', handleYesBtn);
  });
});

closeBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    helpDialog.close();
    redeemDialog.close();
    toggleOverlay();
    yesBtn.removeEventListener('click', handleYesBtn);
  });
});


if (cancelBtn) {
  cancelBtn.addEventListener('click', () => {
    helpDialog.close();
    redeemDialog.close();
    toggleOverlay();
    yesBtn.removeEventListener('click', handleYesBtn);
  });
}