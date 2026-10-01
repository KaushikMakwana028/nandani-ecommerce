// ============================
// Hero Swiper Slider Init (Only when element exists)
// ============================
if (document.querySelector(".heroSwiper") && typeof Swiper !== 'undefined') {
  const heroSwiper = new Swiper(".heroSwiper", {
    loop: true,
    speed: 1200,
    parallax: true,
    effect: "slide",
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".heroSwiper .swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".heroSwiper .swiper-button-next",
      prevEl: ".heroSwiper .swiper-button-prev",
    },
  });
}

// ============================
// Testimonial Swiper Init (Only when element exists)
// ============================
if (document.querySelector(".testimonialSwiper") && typeof Swiper !== 'undefined') {
  const testimonialSwiper = new Swiper(".testimonialSwiper", {
    loop: true,
    spaceBetween: 20,
    slidesPerView: 1,
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: {
      el: ".testimonial-pagination",
      clickable: true,
    },
    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 }
    }
  });
}