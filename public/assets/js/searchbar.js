// fonction pour choisir les dossiers selon certains critères 

function search() {

    // selctionner tous les dossier
    // verifier si les select.value est contenu ds les folder.value
    let folders = document.querySelectorAll('.folderSelect');
    let professor = document.querySelector('#professor');
    let level = document.querySelector('#level');
    let lessonDay = document.querySelector('#day');

    folders.forEach(folder => {

        let searchName = folder.innerText.toLowerCase();

        if ((searchName.includes(professor.value.toLowerCase()) || professor.value == "all") && (searchName.includes(level.value.toLowerCase()) || level.value == "all") && (searchName.includes(lessonDay.value.toLowerCase()) || lessonDay.value == "all")) {
            folder.parentElement.className = "folder";
            // folder.parentElement.classList.remove('hidden');
        } else {
            //! interference avec display nonne et display flex
            // il faut enlever la classe d'origine et ne mettre que celle avec display none
            // folder.parentElement.classList.add('hidden');
            folder.parentElement.className = "hidden";
        }

    });


}