// Get the thumbnail images
const thumbnails = document.querySelectorAll('.thumbnail');

// Get the main image
const mainImage = document.querySelector('#main-image');

// Add event listeners to each thumbnail
thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function () {
        mainImage.src = this.src;
        // Remove the active class from all thumbnails
        thumbnails.forEach(thumbnail => thumbnail.classList.remove('active'));
        // Add the active class to the clicked thumbnail
        this.classList.add('active');
    });
});
