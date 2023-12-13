document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM content loaded');

    function openModal() {
        document.getElementById('postModal').style.display = 'block';
    }

    const closeModal = () => document.getElementById('postModal').style.display = 'none';

    function submitPost() {
        // Add your logic to handle the post submission here
        console.log('Post submitted!');
        closeModal();  // Close the modal after submission
        
        
    }

    document.getElementById('createPostBtn').addEventListener('click', function () {
        console.log('Create Post button clicked!');
        openModal();
    });

    document.querySelector('.close').addEventListener('click', function () {
        console.log('Close button clicked!');
        closeModal();
    });

    document.querySelector('#postModal .modal-content button:last-child').addEventListener('click', function () {
        console.log('Cancel button clicked!');
        closeModal();
    });
});
