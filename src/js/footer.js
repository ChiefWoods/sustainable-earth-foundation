const newsletterForm = document.querySelector('#newsletter form');
const newsletterInput = document.querySelector('#email-input');

newsletterForm.addEventListener('submit', e => {
  e.preventDefault();
  alert('You have subscribed to our newsletter!');
  newsletterInput.value = '';
})