
console.log('hello coco');

//<script type="text/javascript">
function printImg() {
    pwin = window.open(document.querySelector('.print-img')[0].src, "_blank");
    pwin.onload = function () {
        window.print();
    }
}
//</script>




//--------------------------------------------
// source : https://stackoverflow.com/questions/2909033/using-javascript-to-print-images

// A cross browser solution printImage(document.getElementById('buzzBarcode').src)


/**
 * Prints an image by temporarily opening a popup
 * @param {string} src - image source to load
 * @returns {void}
 */
 function printImage(src) {
    var win = window.open('about:blank', "_new");
    win.document.open();
    win.document.write([
        '<html>',
        '   <head>',
        '   </head>',
        '   <body onload="window.print()" onafterprint="window.close()">',
        '       <img src="' + src + '"/>',
        '   </body>',
        '</html>'
    ].join(''));
    win.document.close();
}


img {
    display: block;
    margin: 10px auto;
  }
  
  button {
    font-family: tahoma;
    font-size: 12px;
    padding: 6px;
    display: block;
    margin: 0 auto;
  }


  <img id="buzzBarcode" src="https://barcode.orcascan.com/qrcode/buzz.png?text=to infinity and beyond" width="150" height="150" />
//--------------------------------------------
