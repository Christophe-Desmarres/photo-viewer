// pour l'upload des images
if (document.title == "upload | Image Viewer") {

    const input = document.querySelector('#image_uploads');
    const preview = document.querySelector('.preview');
    // pour afficher le nbre de fichiers selectionnée
    const nbp = document.querySelector(".action");
    const nb = document.createElement('p');

    // input.style.opacity = 0.5;

    input.addEventListener('change', updateImageDisplay);



    function updateImageDisplay() {


        // boucle pour effacer le message ou non de selection de fichiers
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        // recupere les fichiers de l'input
        const curFiles = input.files;

        if (curFiles.length === 0) {
            const imgDescription = document.createElement('p');
            imgDescription.textContent = 'No files currently selected for upload';
            preview.appendChild(imgDescription);
            nbp.removeChild(nb);

        } else {
            nb.textContent = curFiles.length + " fichier(s) séléctionné(s)";
            nbp.append(nb);

            const list = document.createElement('ol');
            preview.appendChild(list);

            for (const file of curFiles) {
                console.log(curFiles);

                // création élément li
                const listItem = document.createElement('li');

                // création élément p
                const imgDescription = document.createElement('p');


                if (validFileType(file)) {

                    imgDescription.textContent = 'Nom : ' + file.name; // + ' Taille : ' + returnFileSize(file.size) + '.';
                    const image = document.createElement('img');
                    image.src = URL.createObjectURL(file);

                    listItem.appendChild(image);
                    listItem.appendChild(imgDescription);
                } else {
                    imgDescription.textContent = 'File name ' + file.name + ': Not a valid file type. Update your selection.';
                    listItem.appendChild(imgDescription);
                }

                list.appendChild(listItem);
            }
        }
    }


    // https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
    const fileTypes = [
        "image/apng",
        "image/bmp",
        "image/gif",
        "image/jpeg",
        "image/jpg",
        "image/pjpeg",
        "image/png",
        "image/svg+xml",
        "image/tiff",
        "image/webp",
        "image/x-icon"
    ];

    function validFileType(file) {
        return fileTypes.includes(file.type);
    }


    function returnFileSize(number) {
        if (number < 1024) {
            return number + 'bytes';
        } else if (number >= 1024 && number < 1048576) {
            return (number / 1024).toFixed(1) + 'KB';
        } else if (number >= 1048576) {
            return (number / 1048576).toFixed(1) + 'MB';
        }
    }

}