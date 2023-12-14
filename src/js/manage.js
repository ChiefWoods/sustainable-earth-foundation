const overlay = document.querySelector('.overlay');
const editBtns = document.querySelectorAll('.edit-btn');
const deleteBtns = document.querySelectorAll('.delete-btn');
const editDialog = document.querySelector('#edit-dialog');
const editForm = document.querySelector('form.dialog-bottom');
const closeBtns = document.querySelectorAll('.close-btn');
const deleteDialog = document.querySelector('#delete-dialog');
const cancelBtn = document.querySelector('#cancel-btn');

function toggleOverlay() {
  overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

editBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    if (editForm.id === 'edit-users') {
      const usernameValue = btn.parentElement.parentElement.querySelector('.user-username').textContent;
      const emailValue = btn.parentElement.parentElement.querySelector('.user-email').textContent;
      const phoneValue = btn.parentElement.parentElement.querySelector('.user-phone').textContent;
      const userPointsValue = btn.parentElement.parentElement.querySelector('.user-points').textContent;

      const usernameInput = editForm.querySelector('#username');
      const emailInput = editForm.querySelector('#email');
      const phoneInput = editForm.querySelector('#phone');
      const userPointsInput = editForm.querySelector('#user-points');

      usernameInput.value = usernameValue;
      emailInput.value = emailValue;
      phoneInput.value = phoneValue;
      userPointsInput.value = userPointsValue;
    } else {
      const usernameValue = btn.parentElement.parentElement.querySelector('.redemption-username').textContent;
      const pointsValue = btn.parentElement.parentElement.querySelector('.redemption-points').textContent;
      const codeValue = btn.parentElement.parentElement.querySelector('.redemption-code').textContent;
      const dateValue = btn.parentElement.parentElement.querySelector('.redemption-date').textContent;

      const usernameInput = editForm.querySelector('#username');
      const pointsInput = editForm.querySelector('#reward-points');
      const codeInput = editForm.querySelector('#reward-code');
      const dateInput = editForm.querySelector('#date-redeemed');

      usernameInput.value = usernameValue;
      pointsInput.value = pointsValue;
      codeInput.value = codeValue;
      dateInput.value = dateValue;
    }
    editDialog.showModal();
    toggleOverlay();
  });
});

deleteBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    deleteDialog.showModal();
    toggleOverlay();
  });
});

cancelBtn.addEventListener('click', () => {
  deleteDialog.close();
  toggleOverlay();
});

closeBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    btn.closest('dialog').close();
    toggleOverlay();
  });
});
