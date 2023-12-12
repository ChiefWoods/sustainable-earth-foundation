// Function to update the table with user data
function updateTable(users) {
    const table = document.getElementById("userTable");

    // Clear existing rows
    table.innerHTML = "<tr><th>Username</th><th>Phone Number</th><th>Email Address</th><th>Points</th><th>Actions</th></tr>";

    // Append new rows
    users.forEach(user => {
        const row = table.insertRow(-1);
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);

        cell1.innerHTML = user.username;
        cell2.innerHTML = user.phone_num;
        cell3.innerHTML = user.email;
        cell4.innerHTML = user.points;

        // Create a delete button with an onClick event
        const deleteButton = document.createElement("button");
        deleteButton.className = "delete";
        deleteButton.setAttribute("data-username", user.username);
        deleteButton.innerHTML = '<img src="../assets/icons/delete/delete_base.svg" width="20px" height="20px">';
        deleteButton.addEventListener("click", function () {
            removeFromTable(user.username, row);
        });

        // Append the delete button to cell5
        cell5.appendChild(deleteButton);
    });
}

async function removeFromTable(username, row) {
    try {
        // Remove the row from the table immediately
        if (row.parentNode) {
            row.parentNode.removeChild(row);
        }

        const formData = new FormData();
        formData.append('delete_username', username);

        const response = await fetch('../php/manage_user.php', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            const data = await response.text();
            if (data === 'success') {
                console.log('User removed from the database.');

                // Fetch updated user data and call updateTable
                const updatedUsersResponse = await fetch('../php/manage_user.php');
                const updatedUsersData = await updatedUsersResponse.json();

                if (updatedUsersData.success) {
                    // Update the table with the latest user data
                    updateTable(updatedUsersData.users);
                } else {
                    console.error('Error updating user data:', updatedUsersData.error);
                }
            } else {
                console.error('Error removing user from the database:', data);
            }
        } else {
            console.error('Failed to remove user. HTTP status:', response.status);
        }
    } catch (error) {
        console.error('An unexpected error occurred:', error);
    }
}

// Example usage: call updateTable with the user data
updateTable(users);