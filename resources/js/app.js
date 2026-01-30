import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

import Alpine from 'alpinejs'

window.addEventListener("load", () => {
  document.body.style.visibility = "visible";
});

window.Alpine = Alpine
Alpine.start()
AOS.init();


