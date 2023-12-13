const fileInput = document.querySelector('input[name="profile_picture"]');

fileInput.addEventListener('change', e => {
  e.target.form.submit();
});