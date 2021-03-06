/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import { Tooltip, Toast, Popover } from 'bootstrap';

import "@fortawesome/fontawesome-free/js/all.js";
import "@fortawesome/fontawesome-free/css/all.css";

(() => {
  let dots = document.querySelectorAll(".dot");
  if (!dots.length) return;

  var slideIndex = 1;
  showSlides(slideIndex);

  // Next/previous controls
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  // Thumbnail image controls
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (!slides.length) return;
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    else if (n < 1) {slideIndex = slides.length}
    else slideIndex = n
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }

  for (let i = 0; i < dots.length; i++) {
      const dot = dots[i];
      dot.addEventListener('click', function() {showSlides(i + 1)})
  }

  document.querySelector(".prev").addEventListener('click', function() {plusSlides(-1)} )
  document.querySelector(".next").addEventListener('click', function() {plusSlides(1)} )
})();
