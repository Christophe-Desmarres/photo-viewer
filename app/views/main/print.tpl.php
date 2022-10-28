<div class='container'>
    <?php
    foreach ($chaine as $image) : ?>
                <img class="print-img"  src="<?= "../../.$image" ?>">
    <?php endforeach; ?>

    <input type="button" value="Print Image"  onclick="printImg()" />

</div>
<script type="text/javascript">
function printImg() {
    pwin = window.open(document.querySelector('.print-img').src, "_blank");
    pwin.onload = function () {
        window.print();
    }
}
</script>