console.log(document.title);
if (document.title == "cart | Image Viewer") {

    const imgList = document.querySelectorAll(".row");
    console.log(imgList);

    // pour chaque ligne
    // je selctionne les bouton + et -
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
        if (nblight.dataset.nblight > 0) {
            nblight.dataset.nblight--;
            nblight.value--;
        }
    }

    // increase number of light format
    function nbLightPlus(e) {
        let btn = e.currentTarget;
        let nblight = btn.closest('td').querySelector('input');
        console.log(nblight.value);
        nblight.dataset.nblight++;
        nblight.steAttribute('value', nblight.value++);
    }

    // decrease number of large format
    function nbLargeMinus(e) {
        let btn = e.currentTarget;
        let nblarge = btn.closest('td').querySelector('input');
        if (nblarge.dataset.nblarge > 0) {
            nblarge.dataset.nblarge--;
            nblarge.value--;
        }
    }

    // increase number of large format
    function nbLargePlus(e) {
        let btn = e.currentTarget;
        let nblarge = btn.closest('td').querySelector('input');
        nblarge.dataset.nblarge++;
        nblarge.value++;
    }
}