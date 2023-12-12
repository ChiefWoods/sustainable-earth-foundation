
// Function to handle logout
function handleLogout() {
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Define the request type, URL, and set asynchronous to true
    xhr.open('GET', '../php/logout.php', true);

    // Set up the event handler for the XMLHttpRequest
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Redirect to the home page after successful logout
            window.location.href = 'SessionEnd.html';
        }
    };

    // Send the XMLHttpRequest
    xhr.send();
}

// Attach the handleLogout function to the click event of the logout button
document.getElementById('logoutBtn').addEventListener('click', handleLogout);
