
// Function to handle the AJAX vote request
function handleVoteAjax(buttonType, postId) {
    try {
        // Validate postId as a positive integer
        if (!Number.isInteger(postId) || postId <= 0) {
            throw new Error('Invalid postId');
        }

        // Send the vote data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: '../php/update_vote.php',
            data: {
                voteType: buttonType,
                postId: postId
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                // You may update the UI here if needed
            },
            error: function(error) {
                // Handle error response
                console.error(error);
            }
        });
    } catch (error) {
        // Log and handle the error
        console.error(error.message);
    }
}

// Function to handle the toggle logic
function handleVoteAndToggle(buttonType, postId) {
    // Get the clicked button
    var button = document.getElementById(buttonType + '_' + postId);

    // Check if the button is found
    if (!button) {
        console.error('Button not found.');
        return;
    }

    // Toggle the image source based on the current state
    var image = button.getElementsByTagName('img')[0];
    if (image) {
        var isClicked = button.classList.toggle('clicked');

        // Check if the opposite button is clicked, and unclick it
        var oppositeButtonType = (buttonType === 'upvote') ? 'downvote' : 'upvote';
        var oppositeButton = document.getElementById(oppositeButtonType + '_' + postId);
        var oppositeImage = oppositeButton.getElementsByTagName('img')[0];

        if (oppositeButton.classList.contains('clicked')) {
            oppositeButton.classList.remove('clicked');
            oppositeImage.src = `../assets/icons/${oppositeButtonType}/${oppositeButtonType}_base.svg`;
        }

        // Set the image source for the clicked button
        image.src = isClicked ? `../assets/icons/${buttonType}/${buttonType}_selected.svg` : `../assets/icons/${buttonType}/${buttonType}_base.svg`;

        // Call the vote logic function
        handleVoteAjax(buttonType, postId);

        // Save the state in local storage
        saveButtonState(buttonType, postId, isClicked);
    }
}

function saveButtonState(buttonType, postId, isClicked) {
    var storageKey = `${buttonType}_${postId}`;
    console.log('Save Storage Key:', storageKey);
    localStorage.setItem(storageKey, isClicked ? 'clicked' : 'unclicked');
}

function loadButtonState(buttonType, postId) {
    var storageKey = `${buttonType}_${postId}`;
    console.log('Load Storage Key:', storageKey);
    var state = localStorage.getItem(storageKey);
    return state === 'clicked';
}

function initializeButtonState(buttonType, postId) {
    console.log('Initializing Button State:', buttonType, postId);
    var isClicked = loadButtonState(buttonType, postId);
    if (isClicked) {
        var button = document.getElementById(buttonType + '_' + postId);
        var image = button.getElementsByTagName('img')[0];
        console.log('Button and Image:', button, image);
        button.classList.add('clicked');
        image.src = `../assets/icons/${buttonType}/${buttonType}_selected.svg`;
    }
}

function preloadImages() {
    var imagePaths = [
        '../assets/icons/upvote/upvote_base.svg',
        '../assets/icons/upvote/upvote_selected.svg',
        '../assets/icons/downvote/downvote_base.svg',
        '../assets/icons/downvote/downvote_selected.svg',
    ];

    for (var i = 0; i < imagePaths.length; i++) {
        var img = new Image();
        img.src = imagePaths[i];
    }
}

// Preload images before initializing button states
preloadImages();


// Save button states just before the page is unloaded (e.g., during a refresh)
window.addEventListener('beforeunload', function () {
    saveButtonState('upvote', 123);  // Example postId, replace with the actual postId
    saveButtonState('downvote', 123);  // Example postId, replace with the actual postId
});

// Initialize button states when the page is loaded
document.addEventListener('DOMContentLoaded', function () {
    initializeButtonState('upvote', 123);  // Example postId, replace with the actual postId
    initializeButtonState('downvote', 123);  // Example postId, replace with the actual postId
});

function submitPost() {
    var postTitle = document.getElementById('postTitle').value;
    var postContent = document.getElementById('postContent').value;

    // Validate if the title and content are not empty
    if (!postTitle.trim() || !postContent.trim()) {
        alert('Please enter both title and content.');
        return;
    }

    // AJAX request to send post data to the server
    $.ajax({
        type: 'POST',
        url: '../php/create_post.php',
        data: {
            postTitle: postTitle,
            postContent: postContent
        },
        success: function (response) {
            console.log('Raw response:', response);

            try {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success === 'Post created successfully.') {
                    console.log('Post created successfully!');
                    alert('Post created successfully!');
                    
                    // Close the modal directly
                    $('#postModal').hide();

                    // You can also redirect to stickywall.html
                    window.location.href = '../html/stickywall.html';
                } else {
                    alert('Error: ' + jsonResponse.error);
                }
            } catch (error) {
                console.error('Error parsing the server response:', error);
                alert('Error parsing the server response.');
            }
        },
        error: function (error) {
            console.error(error);
            // Display a generic error message
            alert('Error submitting the post.');
        }
    });
}






