const notificationBtn = document.querySelector('#notification-btn');
const manageBtn = document.querySelector('#manage-btn');
const dropdown = document.querySelector('.dropdown');

if (notificationBtn) {
  notificationBtn.addEventListener('click', () => {
    dropdown.style.display == 'flex'
      ? dropdown.style.display = 'none'
      : dropdown.style.display = 'flex';
  });
}

if (manageBtn) {
  manageBtn.addEventListener('click', () => {
    dropdown.style.display == 'flex'
      ? dropdown.style.display = 'none'
      : dropdown.style.display = 'flex';
  });
}