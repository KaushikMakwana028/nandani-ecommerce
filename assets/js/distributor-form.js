// ============================
// Distributor Application Form Submit (Demo - Frontend Only)
// Replace with backend/API integration later
// ============================
const distForm = document.getElementById('distributorForm');
const distFormSuccess = document.getElementById('distFormSuccess');

if(distForm){
  distForm.addEventListener('submit', function(e){
    e.preventDefault();

    distForm.style.display = 'none';
    distFormSuccess.style.display = 'block';

    setTimeout(() => {
      distForm.reset();
      distForm.style.display = 'block';
      distFormSuccess.style.display = 'none';
    }, 6000);
  });
}