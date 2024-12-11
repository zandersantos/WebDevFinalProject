/*
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Review Box Javascript Page

    Client Comment: This is the Review Box Javascript page for Critical Components Admins. 
    // This PHP script handles the category creation form on the webpage. 
    // It ensures that only authorized users can access the page using the "admin.php" file for authentication.
    // It also connects to the database using the "connect.php" file to store the new category name and description.
    // When the form is submitted, the title and content are sanitized and then inserted into the database as a new category.
    // After the category is created, the user is redirected to the "index.php" page.
    
    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
*/
// *Function to toggle the visibility of the review box*
function toggleReviewBox() {

    // !Get the element with the ID 'review-box'!
    reviewBox = document.getElementById('review-box');
    // !Toggle the display style between 'none' (hidden) and 'block' (visible)!
    reviewBox.style.display = reviewBox.style.display === 'none' ? 'block' : 'none';
}
// *Function to add a new review to the review list*
function addReview() {
    //!Get the review input field element by its ID!
   const reviewInput = document.getElementById('review-input');
   //!Get the review list element where new reviews will be added!
   const reviewList = document.getElementById('review-list');
   //!Create a new div element to hold the new review!
   const newReview = document.createElement('div');
   //!Set the text content of the new review to the value entered in the input field!
   newReview.textContent = reviewInput.value;
   //!Add a class 'review-item' to the new review for styling!
   newReview.className = 'review-item';
    //!Append the new review as a child of the review list!
   reviewList.appendChild(newReview);

   // !Clear the input!
   reviewInput.value = ''; 
}