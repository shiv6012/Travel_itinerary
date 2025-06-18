// This file contains JavaScript code for the application, handling user interactions, form submissions, and dynamic content updates.

// document.addEventListener('DOMContentLoaded', function() {
//     const loginFormContainer = document.getElementById('loginFormContainer'); // Targeting by ID
//     const signupFormContainer = document.getElementById('signupFormContainer'); // Targeting by ID
//     const switchToSignupLink = document.getElementById('switchToSignup');     // Targeting by ID
//     const switchToLoginLink = document.getElementById('switchToLogin');       // Targeting by ID

//     switchToSignupLink.addEventListener('click', function(event) {
//         event.preventDefault();
//         loginFormContainer.style.display = 'none';
//         signupFormContainer.style.display = 'block';
//     });

//     switchToLoginLink.addEventListener('click', function(event) {
//         event.preventDefault();
//         signupFormContainer.style.display = 'none';
//         loginFormContainer.style.display = 'block';
//     });

//     // You could add more JavaScript functionality here, targeting elements by their IDs
//     const loginForm = document.getElementById('loginForm');
//     loginForm.addEventListener('submit', function(event) {
//         // Example: Prevent default submission and handle with AJAX
//         // event.preventDefault();
//         // const email = document.getElementById('loginEmail').value;
//         // const password = document.getElementById('loginPassword').value;
//         // console.log('Login submitted with:', email, password);
//         // // Send data using fetch or XMLHttpRequest
//     });

//     const signupForm = document.getElementById('signupForm');
//     signupForm.addEventListener('submit', function(event) {
//         // Example: Prevent default submission and handle with AJAX
//         // event.preventDefault();
//         // const username = document.getElementById('signupUsername').value;
//         // const email = document.getElementById('signupEmail').value;
//         // const password = document.getElementById('signupPassword').value;
//         // console.log('Signup submitted with:', username, email, password);
//         // // Send data using fetch or XMLHttpRequest
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');

    signupForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevents the default form submission

        const formData = new FormData(this);

        fetch('sign-up.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text()) // Or response.json() if your server returns JSON
        .then(data => {
            // Handle the response from your PHP script
            console.log(data);
            document.getElementById('signupError').textContent = ''; // Clear any previous errors
            if (data.includes('Signup successful')) {
                // Optionally redirect the user or update the UI
                window.location.href = 'log-in.html?signup=success';
            } else {
                document.getElementById('signupError').textContent = data; // Display error message from PHP
            }
        })
        .catch(error => {
            console.error('Error during signup:', error);
            document.getElementById('signupError').textContent = 'An error occurred during signup.';
        });
    });
});
//Signup pop-up msg Functionality
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    const signupError = document.getElementById('signupError'); // Assuming you have an element with this ID

    signupForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('sign-up.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            signupError.textContent = ''; // Clear any previous errors
            if (data.includes('Signup successful')) {
                // Display a pop-up message
                alert('Signup successful! You can now log in.');
                // Optionally redirect the user after they acknowledge the alert
                window.location.href = 'log-in.html?signup=success';
            } else {
                signupError.textContent = data; // Display error message from PHP
            }
        })
        .catch(error => {
            console.error('Error during signup:', error);
            signupError.textContent = 'An error occurred during signup.';
        });
    });
});
// After creating an itinerary, show a success popup
const successModal = document.getElementById("successModal");
const closeBtn = document.querySelector(".close-button");

function showSuccessPopup() {
    const itinerarySuccess = false; // Placeholder value; replace dynamically in HTML
    if (itinerarySuccess) {
        successModal.style.display = "block";
        return false; // Prevent form from default submission behavior (page reload)
    } else {
        return true; // Allow form submission if not successful
    }
}

function closeSuccessPopup() {
    successModal.style.display = "none";
    // Optionally, you can redirect the user or clear the form here
    window.location.href = "view-itinerary.php"; // Example: Redirect to view itinerary
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == successModal) {
        successModal.style.display = "none";
    }
}


//Website Popup Functionality
document.addEventListener('DOMContentLoaded', function() {
    const popupContainer = document.getElementById('popup-container');
    const closeButton = document.querySelector('.close-button');
    const popupButton = document.getElementById('popup-button');
  
    // Show the popup after a short delay (optional)
    setTimeout(function() {
      popupContainer.style.display = 'flex';
    }, 1000); // Adjust the delay (in milliseconds) as needed
  
    // Close the popup when the close button is clicked
    closeButton.addEventListener('click', function() {
      popupContainer.style.display = 'none';
    });
  
    // Close the popup if the user clicks outside the modal
    window.addEventListener('click', function(event) {
      if (event.target == popupContainer) {
        popupContainer.style.display = 'none';
      }
    });
  
    
  });

// Image Slider Functionality - Home Page
const slider = document.querySelector('.image-slider');
const slideContainer = document.querySelector('.slide-container');
const slides = document.querySelectorAll('.slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const dotsContainer = document.querySelector('.dots-container');
const dots = document.querySelectorAll('.dot');

let currentIndex = 0;

function goToSlide(index) {
    if (index < 0) {
        currentIndex = slides.length - 1;
    } else if (index >= slides.length) {
        currentIndex = 0;
    } else {
        currentIndex = index;
    }

    const translateX = -currentIndex * 100 + '%';
    slideContainer.style.transform = `translateX(${translateX})`;

    updateDots();
}

function updateDots() {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[currentIndex].classList.add('active');
}

if (prevButton && nextButton) {
    prevButton.addEventListener('click', () => goToSlide(currentIndex - 1));
    nextButton.addEventListener('click', () => goToSlide(currentIndex + 1));
}

if (dotsContainer) {
    dotsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('dot')) {
            const index = parseInt(e.target.dataset.index);
            goToSlide(index);
        }
    });
}
// Initialize
updateDots();



document.addEventListener('DOMContentLoaded', function() {
    const itineraryForm = document.getElementById('itinerary-form');
    const itineraryList = document.getElementById('itinerary-list');

    itineraryForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const destination = document.getElementById('destination').value;
        const activities = document.getElementById('activities').value.split(',');

        if (destination && activities.length > 0) {
            addItinerary(destination, activities);
            itineraryForm.reset();
        } else {
            alert('Please fill in all fields.');
        }
    });

    function addItinerary(destination, activities) {
        const itineraryItem = document.createElement('div');
        itineraryItem.classList.add('itinerary-item');
        itineraryItem.innerHTML = `
            <h3>${destination}</h3>
            <ul>
                ${activities.map(activity => `<li>${activity.trim()}</li>`).join('')}
            </ul>
        `;
        itineraryList.appendChild(itineraryItem);
    }
});