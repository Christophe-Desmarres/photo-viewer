<h3>Chargement des images : 2 form en hidden</h3>


<form class="upload__form hidden" action="/upload" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input class="input__name" type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>


<form class="upload__form hidden" method="post" enctype="multipart/form-data" action="/action_page.php">
  <input class="input__name" type="text" placeholder="choisi un nom de dossier">
  <div class="action">
    <label for="image_uploads">Choisi tes images à charger (PNG, JPG)</label>
    <input class="input__name" type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
  </div>
  <div class="preview">
    <p>No files currently selected for upload</p>
  </div>
  <div>
    <button>Submit</button>
  </div>
</form>




<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


// // Check if image file is a actual image or fake image
// if (isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if ($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if (
//   $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//   && $imageFileType != "gif"
// ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {

  d($target_dir);
  d($target_file);
  d($_FILES);
  d($_FILES["fileToUpload"]);
  d($_FILES["fileToUpload"]["tmp_name"]);
  d(basename($_FILES["fileToUpload"]["name"]));

  try {
    fopen($_FILES["fileToUpload"]["tmp_name"], 'x+');
    $result = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    d($result);
  } catch (Exception $ex) {
    d($ex);
  };
  if ($result) {
    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

d($_FILES['fileToUpload']['error']);
?>

<img src="<?= $_FILES["fileToUpload"]["tmp_name"] ?>">