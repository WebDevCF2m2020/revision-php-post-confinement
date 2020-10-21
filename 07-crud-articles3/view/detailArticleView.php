<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notre article : <?= (isset($erreur))?$erreur:$recup['titre']  ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.css" media="screen">
    <link rel="stylesheet" href="https://bootswatch.com/_assets/css/custom.min.css">
</head>
<body>
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="./" class="navbar-brand">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="?p=connect">Connexion</a>
                </li>

            </ul>

        </div>
    </div>
</div>

<div class="container">

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <?php
                if(isset($erreur)):
                ?>

                <h1><?=$erreur?></h1>
                    <p class="lead"><a href="./">Retournez à l'accueil</a></p>

                <?php
                else:
                ?>
                <h1>Notre article : <?=$recup['titre']?></h1>
                    <p class="lead"><a href="./">Retournez à l'accueil</a></p>
                    <p><?=nl2br($recup["texte"])?></p>
                <h5>Par <?=$recup["thename"]?> <?=functionDateModel($recup["thedate"])?></h5>
                <hr>

                <?php

                endif;

                ?>
            </div>

        </div>
    </div>

<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://bootswatch.com/_assets/js/custom.js"></script>
</body>
</html>