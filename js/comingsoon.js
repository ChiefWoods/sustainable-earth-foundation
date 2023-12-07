// comingsoon.js

// Function to open the coming soon modal
function openComingSoonModal() {
    var modal = document.getElementById('comingSoonModal');
    if (modal) {
        modal.style.display = 'block';
    }
}

// Function to close the coming soon modal
function closeComingSoonModal() {
    var modal = document.getElementById('comingSoonModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Event listener for the more button
document.addEventListener('DOMContentLoaded', function () {
    var moreButton = document.querySelector('.more-btn');
    if (moreButton) {
        moreButton.addEventListener('click', openComingSoonModal);
    }
});
