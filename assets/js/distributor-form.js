// ==========================================
// Distributor Application Form Submit Handler
// Real AJAX submission synced with CodeIgniter & MySQL
// ==========================================
document.addEventListener('DOMContentLoaded', function () {
  const distForm = document.getElementById('distributorForm');
  const distFormSuccess = document.getElementById('distFormSuccess');
  const distFormError = document.getElementById('distFormError');
  const submitBtn = document.getElementById('distSubmitBtn');
  const resetBtn = document.getElementById('distResetBtn');

  if (!distForm) return;

  distForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Reset previous error states
    if (distFormError) {
      distFormError.style.display = 'none';
      const errText = distFormError.querySelector('.error-text');
      if (errText) errText.textContent = '';
    }

    // Toggle button spinner
    if (submitBtn) {
      submitBtn.disabled = true;
      const btnText = submitBtn.querySelector('.btn-text');
      const spinner = submitBtn.querySelector('.spinner-border');
      if (btnText) btnText.style.opacity = '0.5';
      if (spinner) spinner.classList.remove('d-none');
    }

    const formData = new FormData(distForm);
    const postUrl = distForm.getAttribute('action') || window.location.href;

    fetch(postUrl, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network error during form submission');
        }
        return response.json();
      })
      .then(data => {
        if (data.status === 'success') {
          // Success: reset form and display success card
          distForm.reset();
          distForm.style.display = 'none';
          if (distFormSuccess) {
            distFormSuccess.style.display = 'block';
            distFormSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        } else {
          // Validation error
          if (distFormError) {
            const errText = distFormError.querySelector('.error-text');
            if (errText) {
              errText.innerHTML = data.message || 'Please check your inputs and try again.';
            } else {
              distFormError.innerHTML = data.message || 'Please check your inputs and try again.';
            }
            distFormError.style.display = 'block';
            distFormError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }
      })
      .catch(error => {
        console.error('Distributor application error:', error);
        if (distFormError) {
          const errText = distFormError.querySelector('.error-text');
          if (errText) {
            errText.textContent = 'An error occurred while submitting your application. Please try again or contact us directly.';
          } else {
            distFormError.textContent = 'An error occurred while submitting your application. Please try again or contact us directly.';
          }
          distFormError.style.display = 'block';
        }
      })
      .finally(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          const btnText = submitBtn.querySelector('.btn-text');
          const spinner = submitBtn.querySelector('.spinner-border');
          if (btnText) btnText.style.opacity = '1';
          if (spinner) spinner.classList.add('d-none');
        }
      });
  });

  // Reset button to allow submitting another application
  if (resetBtn && distFormSuccess) {
    resetBtn.addEventListener('click', function () {
      distFormSuccess.style.display = 'none';
      distForm.style.display = 'block';
      distForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }
});