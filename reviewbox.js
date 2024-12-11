function toggleReviewBox() {
    reviewBox = document.getElementById('review-box');
   reviewBox.style.display = reviewBox.style.display === 'none' ? 'block' : 'none';
}

function addReview() {
   const reviewInput = document.getElementById('review-input');
   const reviewList = document.getElementById('review-list');
   const newReview = document.createElement('div');
   newReview.textContent = reviewInput.value;
   newReview.className = 'review-item';
   reviewList.appendChild(newReview);
   reviewInput.value = ''; // Clear the input
}