
    function handleVote(buttonType, noteIndex) {
        // Get the upvote and downvote buttons
        var upvoteButton = document.getElementById('upvote_' + noteIndex);
        var downvoteButton = document.getElementById('downvote_' + noteIndex);

        // Get the upvote and downvote images
        var upvoteImage = upvoteButton.getElementsByTagName('img')[0];
        var downvoteImage = downvoteButton.getElementsByTagName('img')[0];

        // Check the current state of the upvote and downvote images
        var isUpvoteClicked = upvoteImage.src.endsWith('upvote_selected.svg');
        var isDownvoteClicked = downvoteImage.src.endsWith('downvote_selected.svg');

        // Reset both images to their base state
        upvoteImage.src = "../assets/icons/upvote/upvote_base.svg";
        downvoteImage.src = "../assets/icons/downvote/downvote_base.svg";

        // Toggle the clicked button's image if it was not clicked before
        if (buttonType === 'upvote' && !isUpvoteClicked) {
            upvoteImage.src = "../assets/icons/upvote/upvote_selected.svg";
        } else if (buttonType === 'downvote' && !isDownvoteClicked) {
            downvoteImage.src = "../assets/icons/downvote/downvote_selected.svg";
        }
    }
