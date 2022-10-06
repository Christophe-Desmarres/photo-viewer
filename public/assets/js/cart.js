console.log(document.title);
if (document.title == "cart | Image Viewer") {

    const imgList = document.querySelectorAll(".row");
    console.log(imgList);

    // pour chaque ligne
    // je selctionne les bouton + et -
    // j'ajoute un listener pour ajouter ou diminuer le nombre

    imgList.forEach(row => {
        let rowPlus = row.querySelector('.plus');
        let rowMinus = row.querySelector('.minus');
        rowPlus.addEventListener('click', nbLightPlus);
        rowMinus.addEventListener('click', nbLightMinus);

    });


    function nbLightMinus(e) {
        // console.log(e);
        let btn = e.currentTarget;
        console.log(btn.querySelector("#nblight > p"));
        return btn.querySelector("p").dataset.nblight--;
    }


    function nbLightPlus(e) {
        // console.log(e);
        let btn = e.currentTarget;
        console.log(btn.querySelector("p"));
        return btn.querySelector("p").dataset.nblight++;
    }


}