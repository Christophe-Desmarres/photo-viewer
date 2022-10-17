<?php
$nom_dossier = "./assets/images/";
?>

<div class='container'>

    <h1>Création d'utilisateur :</h1>
    <form method="post" enctype="multipart/form-data" action="/action_page.php">
        <div class="action">

            <label for="pseudo">pseudo</label>
            <input type="text" id="pseudo" name="pseudo">
            <br>
            <label for="lastname">lastname</label>
            <input type="text" id="lastname" name="lastname">
            <br>

            <label for="firstname">firstname</label>
            <input type="text" id="firstname" name="firstname">
            <br>

            <label for="email">email</label>
            <input type="email" id="email" name="email">
            <br>

            <label for="password">password</label>
            <input type="password" id="password" name="password">
            <br>
            <label for="password_cfm">password confirm</label>
            <input type="password" id="password_cfm" name="password_cfm">
            <br>


        </div>
        <div>
            <button>Submit</button>
        </div>
    </form>


</div>