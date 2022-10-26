// pour effacer le message au bout de 4 secondes
// attention à l'animation css de #message de la même durée

let message = document.querySelector('#message');

setTimeout(() => {
    message.innerHTML = "";
    message.classList.value = "hidden";
}, 5000);