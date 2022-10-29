if (document.title == "cart | Image Viewer") {

    /**
     * 
     * bouton plus et moins de chaque photo
     * 
     */

    const imgList = document.querySelectorAll(".row");

    // pour chaque ligne
    // je selectionne les bouton + et -
    // j'ajoute un listener pour ajouter ou diminuer le nombre

    imgList.forEach(row => {
        let rowMinusLight = row.querySelector('.minus.light');
        let rowPlusLight = row.querySelector('.plus.light');
        let rowMinusLarge = row.querySelector('.minus.large');
        let rowPlusLarge = row.querySelector('.plus.large');

        rowMinusLight.addEventListener('click', nbLightMinus);
        rowPlusLight.addEventListener('click', nbLightPlus);
        rowMinusLarge.addEventListener('click', nbLargeMinus);
        rowPlusLarge.addEventListener('click', nbLargePlus);

    });

    // decrease number of light format
    function nbLightMinus(e) {
        let btn = e.currentTarget;
        let nblight = btn.closest('td').querySelector('input');

        // gestion de la valeur de l'input
        if (nblight.dataset.nblight > 0) {
            nblight.dataset.nblight--;
            nblight.value--;
        }
        setColorInput(e);

    }

    // increase number of light format
    function nbLightPlus(e) {
        let btn = e.currentTarget;
        let nblight = btn.closest('td').querySelector('input');
        nblight.dataset.nblight++;
        nblight.setAttribute('value', nblight.value++);
        setColorInput(e);

    }

    // decrease number of large format
    function nbLargeMinus(e) {
        let btn = e.currentTarget;
        let nblarge = btn.closest('td').querySelector('input');
        if (nblarge.dataset.nblarge > 0) {
            nblarge.dataset.nblarge--;
            nblarge.value--;
        }
        setColorInput(e);

    }

    // increase number of large format
    function nbLargePlus(e) {
        let btn = e.currentTarget;
        let nblarge = btn.closest('td').querySelector('input');
        nblarge.dataset.nblarge++;
        nblarge.value++;
        setColorInput(e);

    }

    function setColorInput(e) {

        let btn = e.currentTarget;
        let row = btn.closest('tr');
        let nblight = row.querySelector('.nblight').querySelector('input');
        let nblarge = row.querySelector('.nblarge').querySelector('input');
       
        // gestion du style des input
        if (nblight.dataset.nblight == 0 && nblarge.dataset.nblarge == 0) {
            nblight.style.color = "white";
            nblight.style.backgroundColor = "red";
            nblarge.style.color = "white";
            nblarge.style.backgroundColor = "red";
        } else {
            nblight.style.backgroundColor = "";
            nblarge.style.backgroundColor = "";

            if (nblight.dataset.nblight == 0) {
                nblight.style.color = "red";
            } else {
                nblight.style.color = "black";
            }

            if (nblarge.dataset.nblarge == 0) {
                nblarge.style.color = "red";
            } else {
                nblarge.style.color = "black";
            }
        }

    }


    /**
     * 
     * bouton +1 pour chaque format
     * 
     */

    // je selectionne les bouton ajout +1
    const button1015 = document.querySelector("#order1015");
    const button1520 = document.querySelector("#order1520");

    // si le panier n'est pas vide sinon les boutons n'existent pas
    if (button1015 != null && button1520 != null) {
        button1015.addEventListener('click', addOneAllLight);
        button1520.addEventListener('click', addOneAllLarge);
    }

    // add 1 to all light format
    function addOneAllLight(e) {
        let light = document.querySelectorAll('td.nblight input.nb');

        light.forEach(nblight => {
            nblight.dataset.nblight++;
            nblight.value++;
            nblight.style.backgroundColor = "";
            nblight.style.color = "black";
        });
    }

    // add 1 to all large format
    function addOneAllLarge(e) {
        let large = document.querySelectorAll('td.nblarge input.nb');

        large.forEach(nblarge => {
            nblarge.dataset.nblarge++;
            nblarge.value++;
            nblarge.style.backgroundColor = "";
            nblarge.style.color = "black";
        });
    }
}