  document.addEventListener("DOMContentLoaded", function () {
    const navbarCollapse = document.querySelector(".navbar-collapse");
    const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });

    // Close on nav-link OR mobile contact button click
    document.querySelectorAll(".navbar-nav .nav-link, .navbar-nav .btn-contact")
      .forEach((el) => {
        el.addEventListener("click", () => {
          bsCollapse.hide();
        });
      });

    // Toggle hamburger ↔ cross
    const toggler = document.querySelector(".navbar-toggler");
    const icon = toggler.querySelector(".navbar-toggler-icon");
    const cross = toggler.querySelector(".toggler-cross");

    toggler.addEventListener("click", function () {
      icon.classList.toggle("d-none");
      cross.classList.toggle("d-none");
    });

    // Reset to hamburger when collapsed
    navbarCollapse.addEventListener("hidden.bs.collapse", function () {
      icon.classList.remove("d-none");
      cross.classList.add("d-none");
    });
  });



    // for success message

document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault(); // stop normal form submit

    let formData = new FormData(this);

    fetch("sendmail.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Show SweetAlert success message
        if(data.status === "success"){
            Swal.fire({
                icon: 'success',
                title: 'Sent!',
                text: data.message,
                confirmButtonColor: '#3085d6'
            });
            // Optionally, reset the form
            document.getElementById("contactForm").reset();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message,
            });
        }
    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong. Try again.',
        });
    });
});




    // play video cards

function togglePlay(button) {
  const card = button.closest('.video-card');
  const video = card.querySelector('.video-player');
  const icon = button.querySelector('i');

  console.log("Clicked button for video:", video);

  // Pause all other videos
  document.querySelectorAll('.video-player').forEach(v => {
    if (v !== video) {
      v.pause();
      v.closest('.video-card')
        .querySelector('.play-button i')
        .classList.replace('fa-pause', 'fa-play');
    }
  });

  // Play or pause current video
  if (video.paused) {
    video.play().then(() => {
      console.log("Video playing...");
      icon.classList.replace('fa-play', 'fa-pause');
    }).catch(err => {
      console.error("Play failed:", err);
    });
  } else {
    video.pause();
    console.log("Video paused...");
    icon.classList.replace('fa-pause', 'fa-play');
  }

  // Reset when video ends
  video.onended = () => {
    icon.classList.replace('fa-pause', 'fa-play');
  };
}




// module cards

 // Add fade-in animation to cards when modal opens
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('servicesModal');
            const cards = document.querySelectorAll('.service-card');
            
            modal.addEventListener('shown.bs.modal', function() {
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.animation = `fadeIn 0.5s ease-in ${index * 0.1}s both`;
                    }, 100);
                });
            });

            // Add click handlers for card buttons
            const cardButtons = document.querySelectorAll('.card-btn');
            cardButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const cardTitle = this.closest('.card-body').querySelector('.card-title').textContent;
                    alert(`You clicked on: ${cardTitle}\n\nThis would typically navigate to a detailed service page.`);
                });
            });
        });