import './bootstrap';
import 'flowbite';

function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
      rect.top >= 48 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + 250 &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  var fadeIns = document.querySelectorAll('.fade-in');

  function checkFadeIns() {
    for (var i = 0; i < fadeIns.length; i++) {
      var fadeIn = fadeIns[i];
      if (isElementInViewport(fadeIn)) {
        fadeIn.classList.add('visible');
      } else {
        fadeIn.classList.remove('visible');
      }
    }
  }

  window.addEventListener('scroll', checkFadeIns);
  window.addEventListener('load', checkFadeIns);
