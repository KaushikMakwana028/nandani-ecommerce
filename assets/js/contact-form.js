// ============================
// Contact Form Submit (Demo - Frontend Only)
// Replace with actual backend/PHP/API call later
// ============================
const contactForm = document.getElementById('contactForm');
const formSuccessMsg = document.getElementById('formSuccessMsg');

if(contactForm){
  contactForm.addEventListener('submit', function(e){
    e.preventDefault();

    // Show success message
    contactForm.style.display = 'none';
    formSuccessMsg.style.display = 'block';

    // Reset form after 5 seconds (optional - for demo purposes)
    setTimeout(() => {
      contactForm.reset();
      contactForm.style.display = 'block';
      formSuccessMsg.style.display = 'none';
    }, 5000);
  });
}