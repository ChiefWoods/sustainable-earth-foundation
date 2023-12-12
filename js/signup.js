document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');

    const form = document.getElementById('signupForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        validateForm();
    });

    function validateForm() {
        console.log('validateForm function called');
        const username = document.getElementById('username').value.trim();
        const phoneNum = document.getElementById('phoneNum').value.trim();
        const email = document.getElementById('Email').value.trim();
        const password = document.getElementById('password').value.trim();
        const comPassword = document.getElementById('comPassword').value.trim();

        resetErrorMessages();

        if (!username || !phoneNum || !email || !password || !comPassword) {
            alert('Please insert all the info.');
            return false;
        }

        if (!isValidEmail(email)) {
            alert('Invalid email format.');
            return false;
        }

        if (!isInteger(phoneNum)) {
            alert('Phone numbers must be integers.');
            return false;
        }

        if (username.length < 5) {
            showError('Username must be at least 5 characters', 'username');
            return;
        }

        if (password.length < 6) {
            showError('Password must be at least 6 characters', 'password');
            return;
        }

        if (comPassword.length < 6) {
            showError('Confirm Password must be at least 6 characters', 'comPassword');
            return;
        }

        // Ensure that both passwords match
        if (password !== comPassword) {
            showError('Passwords do not match', 'comPassword');
            return;
        }

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/signup.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Set up the XMLHttpRequest event handler
        xhr.onreadystatechange = function () {
            console.log('Ready state:', xhr.readyState);
            console.log('Status:', xhr.status);

            if (xhr.readyState === 4) {
                try {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        alert('User registered successfully!');
                        window.location.href = '../html/login.html';
                    } else {
                        alert(response.error || 'An unexpected error occurred');
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            }
        };

        const data = new URLSearchParams(new FormData(form));
        xhr.send(data);
    }

    function showError(message, inputField) {
        const inputElement = document.getElementById(inputField);
        const formControl = inputElement.parentElement;
        let errorElement = formControl.querySelector('.error-message');

        if (!errorElement) {
            errorElement = document.createElement('small');
            errorElement.className = 'error-message';
            formControl.appendChild(errorElement);
        }

        errorElement.textContent = message;
        formControl.classList.add('error');
    }

    function resetErrorMessages() {
        const errorInputs = document.querySelectorAll('.error');
        errorInputs.forEach(input => input.classList.remove('error'));

        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(message => message.remove());
    }

    function isValidEmail(email) {
        // You can implement your email validation logic here
        // For simplicity, let's assume any non-empty string is a valid email
        return email.trim() !== '';
    }

    function isInteger(value) {
        // You can implement your integer validation logic here
        // For simplicity, let's check if it's a non-empty string and contains only digits
        return /^\d+$/.test(value.trim());
    }
});
