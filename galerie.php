<?php
include ("include/entete.inc.php");
if ($_SESSION["login"]!=true OR $_SESSION["type"]=="visiteur") {
    header("Location:connexion.php");
}
?>

<div class="container">
    <h1 class="display-3">Parcourir les photos</h1>
    <hr class="my-4">
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
            $query = "SELECT * FROM photo4you.galerie;";
            $req = $db->query($query);
            $result = $req->fetchAll();
            foreach ($result as $ligne) {
                $srcphoto = "images/galerie/".htmlentities($ligne['srcPhoto']);

                echo "<div class='card mb-2'>
                        <img src=".$srcphoto." alt=".$ligne['id_photo']." />
                        <div class='card-body'>
                            <h5 class='card-title'>".$ligne['nomPhoto']."</h5>
                            <p class='card-text'>".$ligne['description']."</p>
                            <button class='btn btn-outline-success'>Acheter ".$ligne['prixPhoto']." crédits</button>
                        </div>
                      </div>";
            }
        ?>
    </div>
</div>
