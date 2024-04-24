export function toggleControlStatus(ele) {
  if (ele.checkValidity()) {
    ele.classList.remove('error');

    ele.value.length
      ? ele.classList.add('success')
      : ele.classList.remove('success');

    ele.nextElementSibling.textContent = '';
  } else {
    ele.classList.remove('success');
    ele.classList.add('error');
    ele.nextElementSibling.textContent = ele.validationMessage;
  }
}

export function validateUsername(ele) {
  if (ele.validity.valueMissing) {
    ele.setCustomValidity('Username is required.')
  } else if (ele.validity.patternMismatch) {
    ele.setCustomValidity('Username must start with an alphabet, and can only contain alphanumeric characters.')
  } else if (ele.validity.tooShort) {
    ele.setCustomValidity('Username must be at least 3 characters long.')
  } else {
    ele.setCustomValidity('')
  }
}

export function validatePassword(ele) {
  if (ele.validity.valueMissing) {
    ele.setCustomValidity('Password is required.')
  } else if (ele.validity.patternMismatch) {
    ele.setCustomValidity('Password must contain at least one number, uppercase letter, and lowercase letter.')
  } else if (ele.validity.tooShort) {
    ele.setCustomValidity('Password must be at least 8 characters long.')
  } else {
    ele.setCustomValidity('')
  }
}

export function validateEmail(ele) {
  if (ele.validity.valueMissing) {
    ele.setCustomValidity('Email is required.')
  } else if (ele.validity.typeMismatch) {
    ele.setCustomValidity('Email is invalid.')
  } else {
    ele.setCustomValidity('')
  }
}

export function validatePhone(ele) {
  if (ele.validity.patternMismatch) {
    ele.setCustomValidity('Phone number should consist of only digits.')
  } else if (ele.validity.tooShort || ele.validity.tooLong) {
    ele.setCustomValidity('Phone number should be 10 digits long.')
  } else {
    ele.setCustomValidity('')
  }
}

export function validateConfirmPassword(ele, password) {
  if (ele.validity.valueMissing) {
    ele.setCustomValidity('Confirm password is required.')
  } else if (ele.value !== password) {
    ele.setCustomValidity('Passwords do not match.')
  } else {
    ele.setCustomValidity('')
  }
}