// Function to update the table with redemption data
function updateRedemptionTable(redemptions) {
    const table = document.getElementById("redemptionTable");

    // Clear existing rows
    table.innerHTML = "<tr><th>ID</th><th>Username</th><th>Used Points</th><th>Voucher Code</th><th>Redemption Date</th><th>Actions</th></tr>";

    // Append new rows
    redemptions.forEach(redemption => {
        const row = table.insertRow(-1);
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);
        const cell6 = row.insertCell(5);

        cell1.innerHTML = redemption.id; // Display the ID
        cell2.innerHTML = redemption.username;
        cell3.innerHTML = redemption.used_points;
        cell4.innerHTML = redemption.reward_code;
        cell5.innerHTML = redemption.redemption_date;

        // Create a delete button with an onClick event
        const deleteButton = document.createElement("button");
        deleteButton.className = "delete";
        deleteButton.setAttribute("data-id", redemption.id); // Use the ID for deletion
        deleteButton.innerHTML = '<img src="../assets/icons/delete/delete_base.svg" width="20px" height="20px">';

        // Append the delete button to cell6
        cell6.appendChild(deleteButton);

        // Attach the click event listener to the delete button
        deleteButton.addEventListener("click", function () {
            console.log("Delete button clicked");
            removeFromRedemptionTable(redemption.id, row);
        });
    });
}





async function removeFromRedemptionTable(redemptionId, row) {
    try {
        // Remove the row from the table immediately
        if (row.parentNode) {
            row.parentNode.removeChild(row);
        }

        const formData = new FormData();
        formData.append('delete_id', redemptionId);

        const response = await fetch('../php/manage_redemption.php', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            try {
                // Try to parse the response as JSON
                const updatedRedemptionData = await response.json();

                if (updatedRedemptionData.success) {
                    // Update the table with the latest redemption data
                    updateRedemptionTable(updatedRedemptionData.redemptions);
                } else {
                    console.error('Error updating redemption data:', updatedRedemptionData.error);
                }
            } catch (jsonError) {
                // Log the error if parsing JSON fails
                console.error('Error parsing JSON:', jsonError);
            }
        } else {
            console.error('Failed to remove redemption. HTTP status:', response.status);
        }
    } catch (error) {
        console.error('An unexpected error occurred:', error);
    }
}

// Example usage: call updateRedemptionTable with the redemption data
updateRedemptionTable(redemptions);


