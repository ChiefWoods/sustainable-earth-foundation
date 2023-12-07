function openHelpModal() {
    var modal = document.getElementById('helpModal');
    modal.style.display = 'block';
}

// Function to close the help modal
function closeHelpModal() {
    var modal = document.getElementById('helpModal');
    modal.style.display = 'none';
}

// Event listener for the help button
document.querySelector('.help-button').addEventListener('click', openHelpModal);