/*
Template Name: Osahanin - Job Portal & Social Network HTML Template
Author: Askbootstrap
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/



(function($) {
  "use strict"; // Start of use strict

// Tooltip
$('[data-toggle="tooltip"]').tooltip();

// Osahan Slider
$('.osahan-slider').slick({
  centerMode: true,
  centerPadding: '30px',
  slidesToShow: 2,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});

})(jQuery); // End of use strict

$('#back-top a').on("click", function () {
  $('body,html').animate({
    scrollTop: 0
  }, 1000);
  return false;
});
// Header scroll class
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $('#header').addClass('header-scrolled fixed-top');
    $('#back-top').fadeIn(500);
    $('.search').css('display', 'flex');
  } else {
    $('#header').removeClass('header-scrolled fixed-top');
    $('#back-top').fadeOut(500);
    $('.search').css('display', 'none');
  }
});