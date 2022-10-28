console.log('hello coco');


// fonction pour choisir les dossiers selon certains critères 

function search() {

    // selctionner tous les dossier
    // verifier si les select.value est contenu ds les folder.value
    let folders = document.querySelectorAll('.folderSelect');
    let professor = document.querySelector('#professor');
    let level = document.querySelector('#level');
    let lessonDay = document.querySelector('#day');

    folders.forEach(folder => {

        let searchName = folder.innerText;

        if ((searchName.includes(professor.value) || professor.value == "all") && (searchName.includes(level.value) || level.value == "all") && (searchName.includes(lessonDay.value) || lessonDay.value == "all")) {
            folder.parentElement.classList.remove('hidden');
        } else {
            folder.parentElement.classList.add('hidden');
        }

    });


}