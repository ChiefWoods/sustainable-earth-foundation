
    function validateForm() {
        var phoneNum = document.getElementById('phoneNum').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var comPhoneNum = document.getElementById('comPhoneNum').value;
        var comEmail = document.getElementById('comEmail').value;
        var comPassword = document.getElementById('comPassword').value;

        if (!phoneNum || !email || !password || !comPhoneNum || !comEmail || !comPassword) {
            alert('Please insert all the info.');
            return false;
        }

        if (!isValidEmail(email)) {
            alert('Invalid email format.');
            return false;
        }

        if (!isInteger(phoneNum) || !isInteger(comPhoneNum)) {
            alert('Phone numbers must be integers.');
            return false;
        }
        
        if (phoneNum !== comPhoneNum) {
            alert('Phone Number and Confirm Phone Number must match.');
            return false;
        }
        if (email !== comEmail) {
            alert('Email and Confirm Email must match.');
            return false;
        }
        if (password !== comPassword) {
            alert('Password and Confirm Password must match.');
            return false;
        }
        return true;
      
    }

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isInteger(value) {
        return /^\d+$/.test(value);
    }
