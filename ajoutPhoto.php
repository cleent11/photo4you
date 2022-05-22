<?php
include ('include/entete.inc.php');

if ($_SESSION['login']!=true OR $_SESSION['type']=='visiteur')
{
    header("Location:connexion.php");
}
?>

<?php
if (isset($_POST['Ajouter']))
{
  $nomP = htmlentities($_POST['nomP']);
  $descP = htmlentities($_POST['descP']);
  $prixP = htmlentities($_POST['prixP']);

  // Traitement de la photo
  if (isset($_FILES) && count($_FILES)>0)
  {
    $urlPhoto = $_FILES['srcP'];
    $nom_fichier = $urlPhoto['name'];
    if (strlen($nom_fichier)==0) 
    {
      $nom_fichier="user.png";
    }
  }
    // On prépare la requête pour ajouter en BDD
    $instruction = $db->prepare('INSERT INTO photo4you.galerie (srcPhoto, nomPhoto, description, prixPhoto) VALUES (:srcP, :nomP, :descP, :prixP)');
    $instruction->bindParam(':srcP', $nom_fichier, PDO::PARAM_STR);
    $instruction->bindParam(':nomP', $nomP, PDO::PARAM_STR);
    $instruction->bindParam(':descP', $descP, PDO::PARAM_STR);
    $instruction->bindParam(':prixP', $prixP, PDO::PARAM_INT);

    try
    {
      $instruction->execute();
      move_uploaded_file($urlPhoto['tmp_name'],'images/galerie/'.$nom_fichier);
      echo '<script>
      alert("Vous avez bien publier votre photo");
      location.href="galerie.php";
      </script>';
    }
    catch(PDOException $e)
    {
      echo "<br/><h1> Erreur : </h1>" . $e->getMessage();
    }
}
?>

<div class="container">
  <h1 class="display-3">Rajouter une photo à la galerie</h1>
  <hr class="my-4">

  <form method="post" id="formId" enctype="multipart/form-data" novalidate>
    <div class="form-group row">
      <div class="col-md-4 mb-3">
        <label for="nomP">Nom de la photo : </label>
        <input type="text" class= "form-control" name="nomP" id="nomP" minlength="5" maxlength="50" placeholder="Le nom" required>
      </div>
      <div class="invalid-feedback">
          Vous devez fournir un nom pour la photo.
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4 mb-3">
        <label for="descP">Description de la photo :</label>
        <input type="text-area" class="form-control" name="descP" id="descP" minlength="3" maxlength="255" placeholder="La description" required>
      </div>
      <div class="invalid-feedback">
          Vous devez fournir une description.
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4 mb-3">
        <label for="prixP">Prix de la photo : </label>
        <input type="integer" class= "form-control" name="prixP" id="prixP" placeholder="Le prix" required>
      </div>
      <div class="invalid-feedback">
          Vous devez fournir un prix pour la photo.
      </div>
    </div>

    <div class="form-group row mb-2">
      <div class="col-md-4 mb-3">
        <label for="srcP">Photo : </label>
        <input type="file" onchange="actuPhoto(this)" class= "form-control-file mb-2" name="srcP" id="srcP" accept="image/jpeg, image/png, image/gif" required>
        <img src="" id="photo"  width=20% class="img-responsive float-right mb-2" >
      </div>
      <div class="invalid-feedback">
          Vous devez fournir une photo.
      </div>
    </div>
    
    <input type="submit" value="Ajouter" class="btn btn-outline-success" name="Ajouter" />
  </form>
</div>

<script>
    function actuPhoto(element)
{
  var image=document.getElementById("srcP");
  var fReader = new FileReader();
  fReader.readAsDataURL(image.files[0]);
  fReader.onloadend = function(event)
  {
    var img = document.getElementById("photo");
    img.src = event.target.result;
  }
}

var mail=document.getElementById("nomP");
mail.addEventListener("blur", function (evt) {
  console.log("Perte de focus pour le nom");
});

var mail=document.getElementById("descP");
mail.addEventListener("blur", function (evt) {
  console.log("Perte de focus pour la description");
});

var mail=document.getElementById("prixP");
mail.addEventListener("blur", function (evt) {
  console.log("Perte de focus pour le prix");
});

var mail=document.getElementById("srcP");
mail.addEventListener("blur", function (evt) {
  console.log("Perte de focus pour la photo");
});

(function() {
  "use strict"
  window.addEventListener("load", function() {
    var form = document.getElementById("formId")
    form.addEventListener("submit", function(event) {
      if (form.checkValidity() == false) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add("was-validated")
    }, false)
  }, false)

}())

</script>