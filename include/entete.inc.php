<?php
  session_start();
  if (!isset($_SESSION['type']))
  {
    $_SESSION['type']="visiteur";
  }
  if (!isset($_SESSION['login']))
  {
    $_SESSION['login']="false";
  }
  require_once ('accessbase.php');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<header>
  <?php
    if ($_SESSION['login']!="true" OR $_SESSION['type']=="visiteur")
    {
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <div class="container-fluid">
                <a class="navbar-brand">PhotoForYou</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="galerie.php">Galerie</a>
                    </li>
                  </ul>
                  <form class="d-flex">
                    <a href="connexion.php" class="btn btn-outline-light mx-1 mt-2">Connexion</a>
                    <a href="inscription.php" class="btn btn-outline-warning mx-1 mt-2" type="submit">Inscription</a>
                  </form>
                </div>
              </div>
            </nav>';
    } else {
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <div class="container-fluid">
                <a class="navbar-brand">PhotoForYou</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="galerie.php">Galerie</a>
                    </li>
                  </ul>
                  <form class="d-flex">
                    <a href="consulProfil.php" class="btn btn-outline-light mx-1 mt-2">Profil</a>
                    <a href="deconnexion.php" class="btn btn-outline-warning mx-1 mt-2" type="submit">Déconnexion</a>
                  </form>
                </div>
              </div>
            </nav>';
    }
  ?>
</header>