import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
new WOW().init();

const theme = localStorage.getItem("theme") ?? "";

document.documentElement.classList.add(theme);
