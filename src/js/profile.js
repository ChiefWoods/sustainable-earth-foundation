const fileInput = document.querySelector('#profile-picture');

fileInput.addEventListener('change', e => {
  e.target.form.submit();
});