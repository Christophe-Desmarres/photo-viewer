// pour afficher les input check pour choisir les photos du dossier courant 
// pour modifier le boutton de selection puis validation de la selection


// pour récuperer l'élément avec le nombre d'images séléctionnées
let count = document.querySelector('#count');

// pour récupérer toutes les checkbox
let checkbox = document.querySelectorAll('[type=checkbox]');

// initialisation variable pour le nombre de photos séléctionnées
let nborder = 0;

// pour chaque checkbox, j'ajoute un listener lors d'un changement d'état
checkbox.forEach(input => {
    
    if (input.checked) {nborder++;}

    input.addEventListener('change', (e) => {
        let input = e.currentTarget;

        // je mets à jour la quantité et je l'affiche
        if (input.checked) {
            nborder++;
        } else {
            nborder--;
        }
        count.textContent = '(' + nborder + ')';
    });

    count.textContent = '(' + nborder + ')';

});

// pour enlever l'image de chargement
let load = document.querySelector('#loading');
load.remove();
// load.classList.add('hidden');







button.addEventListener('click', (e) => {
    e.preventDefault();
    let button = e.currentTarget;
    button.classList.add('hidden');

    let validateButton = document.querySelector('[name=ordervalidate]');
    validateButton.classList.remove('hidden');

    let checkbox = document.querySelectorAll('[type=checkbox]');
    console.log(checkbox);

    checkbox.forEach(input => {
        console.log(input);
    });

});

// setTimeout(() => {
//     message.innerHTML = "";
//     message.classList.value = "hidden";
// }, 5000);