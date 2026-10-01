// ==========================================
// Contact Enquiry Form Submit Handler
// Real AJAX submission synced with CodeIgniter & MySQL
// ==========================================
document.addEventListener('DOMContentLoaded', function () {
  const contactForm = document.getElementById('contactForm');
  const formSuccessMsg = document.getElementById('formSuccessMsg');
  const formSuccessText = document.getElementById('formSuccessText');
  const formErrorMsg = document.getElementById('formErrorMsg');
  const submitBtn = document.getElementById('contactSubmitBtn');

  if (!contactForm) return;

  contactForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Reset previous alert states
    if (formErrorMsg) {
      formErrorMsg.style.display = 'none';
      formErrorMsg.innerHTML = '';
    }

    // Toggle button loading state
    if (submitBtn) {
      submitBtn.disabled = true;
      const btnText = submitBtn.querySelector('.btn-text');
      const btnSpinner = submitBtn.querySelector('.btn-spinner');
      if (btnText) btnText.classList.add('d-none');
      if (btnSpinner) btnSpinner.classList.remove('d-none');
    }

    const formData = new FormData(contactForm);
    const postUrl = contactForm.getAttribute('action') || window.location.href;

    fetch(postUrl, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.status === 'success') {
          // Success state
          contactForm.reset();
          contactForm.style.display = 'none';
          if (formSuccessText && data.message) {
            formSuccessText.textContent = data.message;
          }
          if (formSuccessMsg) {
            formSuccessMsg.style.display = 'block';
          }
        } else {
          // Validation error state
          if (formErrorMsg) {
            formErrorMsg.innerHTML = data.message || 'Please check the form inputs and try again.';
            formErrorMsg.style.display = 'block';
          }
        }
      })
      .catch(error => {
        console.error('Contact submission error:', error);
        if (formErrorMsg) {
          formErrorMsg.innerHTML = 'Unable to send message right now. Please try again or call us directly.';
          formErrorMsg.style.display = 'block';
        }
      })
      .finally(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          const btnText = submitBtn.querySelector('.btn-text');
          const btnSpinner = submitBtn.querySelector('.btn-spinner');
          if (btnText) btnText.classList.remove('d-none');
          if (btnSpinner) btnSpinner.classList.add('d-none');
        }
      });
  });
});