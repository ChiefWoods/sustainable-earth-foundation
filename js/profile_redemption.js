document.addEventListener('DOMContentLoaded', function () {
    // Your other code...

    // Function to update the table with redemption data
    function updateRedemptionTable(redemptions) {
        const table = document.getElementById("redemptionTable");

        // Clear existing rows
        table.innerHTML = "<tr><th>Used Points</th><th>Reward Code</th><th>Redemption Date</th></tr>";

        // Check if redemptions is defined and is an array
        if (Array.isArray(redemptions)) {
            // Append new rows
            redemptions.forEach(redemption => {
                const row = table.insertRow(-1);
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);

                cell1.innerHTML = redemption.used_points;
                cell2.innerHTML = redemption.reward_code;
                cell3.innerHTML = redemption.redemption_date;
            });
        }
    }

    // Call the function with the redemptions variable
    updateRedemptionTable(redemptions);
});
