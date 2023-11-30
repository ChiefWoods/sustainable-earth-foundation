var isDropdownVisible = false;

function myFunction() {
    var dropbtn = document.getElementById("dropbtn");
    var dropdownContent = document.getElementById("myDropdown");

    // Toggle the dropdown visibility
    isDropdownVisible = !isDropdownVisible;

    // Set the image and display property based on the dropdown visibility
    dropbtn.querySelector("img").src = isDropdownVisible ? "icon/clicked-bell.png" : "icon/bell.png";
    dropdownContent.style.display = isDropdownVisible ? "block" : "none";
}

// Add a click event listener to the document body
document.body.addEventListener("click", function (event) {
    var dropbtn = document.getElementById("dropbtn");

    // Check if the click was outside the button
    if (!dropbtn.contains(event.target)) {
        // Close the dropdown if it's currently open
        if (isDropdownVisible) {
            myFunction();
        }
    }
});

// Handle clicks on the button itself
document.getElementById("dropbtn").addEventListener("click", function (event) {
    event.stopPropagation(); // Prevent the click from reaching the document body
    myFunction();
});
