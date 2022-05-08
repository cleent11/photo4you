<?php
include ("include/entete.inc.php");

if (isset($_POST['rajouter']))
{
    $cred = htmlentities($_POST['cred']);
    $requete = 'UPDATE photo4you.utilisateur SET credit = credit + :credit WHERE id_user = '.$_SESSION['idUtilisateur'].';';
    $instruction = $db->prepare($requete);
    $instruction->bindParam(':credit', $cred, PDO::PARAM_INT);

    try {
        $instruction->execute();
        $query = "SELECT * from photo4you.utilisateur WHERE id_user = ".$_SESSION['idUtilisateur'].";";
        $req = $db->query($query);
        $result = $req->fetch();
        $_SESSION['credit'] = htmlentities($result['credit']);
        echo '<script>
        alert("Vous aves bien rajouter vos crédits !");
        location.href="consulProfil.php";
        </script>';
    } catch(PDOException $e) {
        echo "erreur : ".$e->getMessage();
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form id="ajCred" method="post">
                <label class="form-label mt-2" for="cred"> rajouter des credits </label>
                <input class="form-control my-1" type="number" name="cred" id="cred" />

                <button class="btn btn-outline-success my-2" type="submit" value="rajouter" name="rajouter"> ajouter </button>
            </form>
        </div>
        <div class="col-md-8"></div>
    </div>
</div>

<?php include ("include/piedDePage.inc.php")?>