<?php
// Dependencies
require_once "model/articlesModel.php";
require_once "model/usersModel.php";
require_once "model/functionDateModel.php";
require_once "model/cutTheTextModel.php";
require_once "model/paginationModel.php";
// disconnect
require_once "model/disconnectModel.php";

// on veut se déconnecter
if(isset($_GET['p'])&&$_GET['p']=="disconnect"){
    disconnectModel();
    header("Location: ./");
    exit;
}

// si on est sur le détail d'un article
if(isset($_GET["detailArticle"])){
    // conversion en int, vaut 0 si la conversion échoue
    $idArticles = (int) $_GET["detailArticle"];
    // si la convertion échoue redirection sur l'accueil
    if(!$idArticles) {
        header("Location: ./");
        exit();
    }
    // appel de la fonction du modèle articlesModel.php
    $recup = articleLoadFull($db,$idArticles);

    // pas d'article, la page n'existe pas
    if(!$recup){
        $erreur = "Cet article n'existe plus";
    }

    // view
    require_once "view/adminDetailArticleView.php";
    exit();

}

// on a cliqué sur créer un article

if(isset($_GET['p'])&&$_GET['p']=="create"){

    // on récupère tous les auteurs potentiels
    $recup_autors = AllUser($db);

    require_once "view/adminInsertArticleView.php";
    exit();
}

// Mise en place de la pagination


if(isset($_GET['pg'])){
    $pgactu = (int) $_GET['pg'];
    if(!$pgactu) $pgactu=1;
}else{
    $pgactu = 1;
}
// calcul pour la requête - nombre d'articles totaux, sans erreurs SQL ce sera toujours un int, de 0 à ...
$nbTotalArticles = countAllArticles($db);

$nb_per_page_admin = 10;

// Calcul pour avoir la première partie du LIMIT *, 10 dans la requête stockée dans articlesModel.php nommée articlesLoadResumePagination()
$debut_tab = ($pgactu-1)*$nb_per_page_admin;

// requête avec le LIMIT appliqué
$recupPagination = articlesLoadResumePagination($db,$debut_tab,$nb_per_page_admin);

// pas d'articles
if(!$recupPagination){
    $erreur = "Pas encore d'article";
}else {
    // nous avons des articles, création de la pagination si nécessaire
    $pagination = paginationModel($nbTotalArticles, $pgactu, $nb_per_page_admin);
}

// Default View
require_once "view/adminIndexView.php";