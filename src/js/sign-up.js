import { toggleControlStatus, validateUsername, validatePassword, validateEmail, validatePhone, validateConfirmPassword } from './util.js';

const usernameInput = document.querySelector('[name="username"]');
const emailInput = document.querySelector('[name="email"]');
const phoneInput = document.querySelector('[name="phone"]');
const passwordInput = document.querySelector('[name="password"]');
const confirmInput = document.querySelector('[name="confirm"]');

usernameInput.addEventListener('input', () => {
  validateUsername(usernameInput);
  toggleControlStatus(usernameInput);
})

emailInput.addEventListener('input', () => {
  validateEmail(emailInput);
  toggleControlStatus(emailInput);
})

phoneInput.addEventListener('input', () => {
  validatePhone(phoneInput);
  toggleControlStatus(phoneInput);
})

passwordInput.addEventListener('input', () => {
  validatePassword(passwordInput);
  toggleControlStatus(passwordInput);
})

confirmInput.addEventListener('input', () => {
  validateConfirmPassword(confirmInput, passwordInput);
  toggleControlStatus(confirmInput);
})