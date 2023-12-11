const notificatioBtn = document.querySelector('#notification-btn');
const manageBtn = document.querySelector('#manage-btn');
const dropdown = document.querySelector('.dropdown');

notificatioBtn.addEventListener('click', () => {
  dropdown.style.display == 'flex'
  ? dropdown.style.display = 'none'
  : dropdown.style.display = 'flex';
});

manageBtn.addEventListener('click', () => {
  dropdown.style.display == 'flex'
  ? dropdown.style.display = 'none'
  : dropdown.style.display = 'flex';
});
