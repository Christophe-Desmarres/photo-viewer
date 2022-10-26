// pour effacer le message au bout de 5 secondes

let message = document.querySelector('#message');

setTimeout(() => {
    message.innerHTML = "";
    message.classList.value = "hidden";
}, 5000);