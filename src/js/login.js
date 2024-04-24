import { toggleControlStatus, validateUsername, validatePassword } from './util.js';

const usernameInput = document.querySelector('[name="username"]');
const passwordInput = document.querySelector('[name="password"]');

usernameInput.addEventListener('input', () => {
  validateUsername(usernameInput);
  toggleControlStatus(usernameInput);
})

passwordInput.addEventListener('input', () => {
  validatePassword(passwordInput);
  toggleControlStatus(passwordInput);
})