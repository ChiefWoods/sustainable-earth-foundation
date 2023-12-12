const newsletterForm = document.querySelector('#newsletter form');
const emailInput = document.querySelector('#email-input');

newsletterForm.addEventListener('submit', e => {
  e.preventDefault();
  alert('You have subscribed to our newsletter!');
  emailInput.value = '';
})