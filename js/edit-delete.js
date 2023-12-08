document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM content loaded');

    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    const closeModal = (modalId) => document.getElementById(modalId).style.display = 'none';

    function submitPost() {
        // Add your logic to handle the post submission here
        console.log('Post submitted!');
        closeModal('editModal');  // Close the modal after submission
    }

    function openEditModal() {
        openModal('editModal');
        // Add logic to populate the edit form with post data
    }

    function submitEditedPost() {
        // Add logic to handle the submission of edited post
        // Close the modal after saving changes
        console.log('Edited post submitted!');
        closeModal('editModal');
    }

    function confirmDelete() {
        // Add logic to handle post deletion
        // Close the modal after confirming deletion
        console.log('Post deleted!');
        closeModal('deleteModal');
    }

    // Edit Button Event Listener
    const editButtons = document.querySelectorAll('.edit');
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            console.log('Edit button clicked!');
            openEditModal();
        });
    });

    // Delete Button Event Listener
    const deleteButtons = document.querySelectorAll('.delete');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            console.log('Delete button clicked!');
            openModal('deleteModal');
        });
    });

    // Close and Cancel Button Event Listeners
    document.querySelector('#editModal .close').addEventListener('click', function () {
        console.log('Close button clicked!');
        closeModal('editModal');
    });

    document.querySelector('#editModal .modal-content button:last-child').addEventListener('click', function () {
        console.log('Cancel button clicked!');
        closeModal('editModal');
    });

    document.querySelector('#deleteModal .close').addEventListener('click', function () {
        console.log('Close button clicked!');
        closeModal('deleteModal');
    });

    document.querySelector('#deleteModal .modal-content button.cancel-btn').addEventListener('click', function () {
        console.log('Cancel button clicked!');
        closeModal('deleteModal');
    });

    document.querySelector('#editModal .modal-content button.submit-btn').addEventListener('click', function () {
        console.log('Save Changes button clicked!');
        submitEditedPost();
    });

    document.querySelector('#deleteModal .modal-content button.confirm-btn').addEventListener('click', function () {
        console.log('Confirm Delete button clicked!');
        confirmDelete();
    });
});