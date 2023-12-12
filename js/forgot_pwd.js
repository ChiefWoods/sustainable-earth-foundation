document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');

    const form = document.getElementById('passwordForm');
    const username = document.getElementById('username');
    const newPassword = document.getElementById('newPassword');
    const comNewPassword = document.getElementById('comNewPassword');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        validateForm();
    });

    function validateForm() {
        console.log('validateForm function called');
        const usernameValue = username.value.trim();
        const newPasswordValue = newPassword.value.trim();
        const comNewPasswordValue = comNewPassword.value.trim();

        resetErrorMessages();

        if (usernameValue.length < 5) {
            showError('Username must be at least 5 characters', username);
            return; // Stop execution if there's an error
        }
        if (newPasswordValue.length < 6) {
            showError('New Password must be at least 6 characters', newPassword);
            return;
        }

        if (comNewPasswordValue.length < 6) {
            showError('Confirm New Password must be at least 6 characters', comNewPassword);
            return;
        }

        // Ensure that both passwords match
        if (newPasswordValue !== comNewPasswordValue) {
            showError('Passwords do not match', comNewPassword);
            return;
        }

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/forgot_pwd.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Set up the XMLHttpRequest event handler
        xhr.onreadystatechange = function () {
            console.log('Ready state:', xhr.readyState);
            console.log('Status:', xhr.status);

            if (xhr.readyState === 4) {
                try {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        alert('Password updated successfully!');
                        window.location.href = response.redirect;
                    } else {
                        if (response.error === 'User not found') {
                            showError('Username is wrong!', username);
                        } else {
                            alert(response.error);
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            }
        };

        const data = new URLSearchParams(new FormData(form));
        xhr.send(data);
    }

    function showError(message, inputField = null) {
        const formControl = inputField ? inputField.parentElement : form;
        let errorElement = formControl.querySelector('.error-message');

        if (!errorElement) {
            errorElement = document.createElement('small');
            errorElement.className = 'error-message';
            formControl.appendChild(errorElement);
        }

        errorElement.textContent = message;

        if (inputField) {
            inputField.parentElement.classList.add('error');
        }
    }

    function resetErrorMessages() {
        const errorInputs = document.querySelectorAll('.error');
        errorInputs.forEach(input => input.classList.remove('error'));

        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(message => message.remove());
    }
});
