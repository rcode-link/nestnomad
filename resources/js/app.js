import Alpine from "alpinejs";
import "./tour.js";

window.Alpine = Alpine;

Alpine.start();
new WOW().init();

const theme = localStorage.getItem("theme") ?? "";

document.documentElement.classList.add(theme);
