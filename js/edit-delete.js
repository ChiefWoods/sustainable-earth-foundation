function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function confirmDelete(event) {
    // Show the delete confirmation modal
    openModal('deleteModal');

    // Set the data-post-id attribute on the deleteModal
    var postId = event.target.closest('.note').dataset.postId;
    document.getElementById('deleteModal').dataset.postId = postId;

    // Add an event listener to confirm deletion
    document.querySelector('#deleteModal .confirm-btn').addEventListener('click', function () {
        // Get the postId from the dataset as a string
        var postIdToDelete = document.getElementById('deleteModal').dataset.postId;

        // Convert postIdToDelete to a number if necessary
        // var postIdToDeleteNumber = parseInt(postIdToDelete, 10);

        // AJAX request to delete post data in the database
        $.ajax({
            type: 'POST',
            url: '../php/delete_post.php',
            data: { postId: postIdToDelete },
          // Updated success callback for delete
          success: function (response) {
            console.log('Raw response:', response);
        
            // Check if the response contains 'success'
            if (response.includes('success')) {
                // Post deleted successfully
                alert('Post deleted successfully!');
                closeModal('deleteModal');
                // Reload the page if needed
                window.location.reload();
            } else {
                // Display error message
                alert('Error deleting post: ' + response);
            }
        },

            error: function (error) {
                console.error(error);
                // Display a generic error message
                alert('Error deleting the post.');
            }
        });
    });
}

function submitEditedPost() {
    var postId = document.getElementById('editModal').dataset.postId;
    var editPostTitle = document.getElementById('editPostTitle').value;
    var editPostContent = document.getElementById('editPostContent').value;

    // Validate if the title and content are not empty
    if (!editPostTitle.trim() || !editPostContent.trim()) {
        alert('Please enter both title and content.');
        return;
    }

    // AJAX request to update post data in the database
    $.ajax({
        type: 'POST',
        url: '../php/update_post.php',
        data: {
            postId: postId,
            editPostTitle: editPostTitle,
            editPostContent: editPostContent
        },
        success: function (response) {
            console.log('Raw response:', response);

            if (response.trim() === 'success') {
                // Post updated successfully
                alert('Post updated successfully!');
                closeModal('editModal');
                window.location.reload();
              
            } else {
                // Display error message
                alert('Error updating post: ' + response);
            }
        },
        error: function (error) {
            console.error(error);
            // Display a generic error message
            alert('Error updating the post.');
        }
    });
}




document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM content loaded');

    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function submitPost() {
        // Add your logic to handle the post submission here
        console.log('Post submitted!');
        closeModal('editModal');  // Close the modal after submission
    }

    function openEditModal() {
        var postId = this.closest('.note').dataset.postId;
        console.log('Editing post with ID:', postId);
    
        // Set the data-post-id attribute on the editModal
        document.getElementById('editModal').dataset.postId = postId;
        document.getElementById('deleteModal').dataset.postId = postId; // Add this line
        console.log('Opening delete modal for post ID:', postId);
        $.ajax({
            type: 'POST',
            url: '../php/get_post_data.php',
            data: { postId: postId },
            success: function (response) {
                var postData = JSON.parse(response);
                $('#editPostTitle').val(postData.title);
                $('#editPostContent').val(postData.content);
                openModal('editModal');
            },
            error: function (error) {
                console.error('Error fetching post data:', error);
            }
        });
    }



    // Edit Button Event Listener
    const editButtons = document.querySelectorAll('.edit');
    editButtons.forEach(function (button) {
        button.addEventListener('click', openEditModal);
    });

    const deleteButtons = document.querySelectorAll('.delete');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', confirmDelete);
    });

    document.querySelector('#saveChangesBtn').addEventListener('click', submitEditedPost);

    // Close and Cancel Button Event Listeners
    document.querySelector('#editModal .close').addEventListener('click', function () {
        closeModal('editModal');
    });

    document.querySelector('#editModal .modal-content button:last-child').addEventListener('click', function () {
        closeModal('editModal');
    });

    document.querySelector('#deleteModal .close').addEventListener('click', function () {
        closeModal('deleteModal');
    });

    document.querySelector('#deleteModal .modal-content button.cancel-btn').addEventListener('click', function () {
        closeModal('deleteModal');
    });

    document.querySelector('#editModal .modal-content button.submit-btn').addEventListener('click', submitEditedPost);

    document.querySelector('#deleteModal .modal-content button.confirm-btn').addEventListener('click', function () {
        // This event listener is now added dynamically in the confirmDelete function
    }); 
});


