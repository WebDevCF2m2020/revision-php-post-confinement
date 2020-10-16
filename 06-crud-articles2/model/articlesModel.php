<?php
// Load all articles with author
function articlesLoadAll($cdb){
    $req = "SELECT * FROM articles a 
	INNER JOIN users u 
		ON a.users_idusers = u.idusers
ORDER BY a.thedate DESC;";
    $recup = mysqli_query($cdb,$req);
    // si au moins 1 résultat
    if(mysqli_num_rows($recup)){
        // on utilise le fetch all car il peut y avoir plus d'un résultat
        return mysqli_fetch_all($recup,MYSQLI_ASSOC);
    }
    // no result
    return false;
}

// Load all articles with author but with 300 caracters from "texte"
function articlesLoadAllResume($cdb){
    $req = "SELECT a.idarticles, a.titre, LEFT(a.texte,300) AS texte, a.thedate, u.idusers, u.thename 
FROM articles a 
	INNER JOIN users u 
		ON a.users_idusers = u.idusers
ORDER BY a.thedate DESC;";
    $recup = mysqli_query($cdb,$req);
    // si au moins 1 résultat
    if(mysqli_num_rows($recup)){
        // on utilise le fetch all car il peut y avoir plus d'un résultat
        return mysqli_fetch_all($recup,MYSQLI_ASSOC);
    }
    // no result
    return false;
}

// Count number of articles
function countAllArticles($c){
    // le count renvoie une ligne de résultat avec le nombre d'articles, utiliser la clef primaire permet d'éviter qu'il compte réellement le nombre d'articles: c'est un résultat se trouvant en début du code de la table (dans l'index)
    $req = "SELECT COUNT(idarticles) AS nb
FROM articles";
    $recup = mysqli_query($c,$req);
    $out = mysqli_fetch_assoc($recup);
    return $out["nb"];
}

// Load all articles with author but with 300 caracters from "texte" with pagination LIMIT
function articlesLoadResumePagination($cdb,$begin,$nbperpage=10){
    $begin = (int) $begin;
    $nbperpage = (int) $nbperpage;
    $req = "SELECT a.idarticles, a.titre, LEFT(a.texte,300) AS texte, a.thedate, u.idusers, u.thename 
FROM articles a 
	INNER JOIN users u 
		ON a.users_idusers = u.idusers
ORDER BY a.thedate DESC 
LIMIT $begin, $nbperpage;";
    $recup = mysqli_query($cdb,$req);
    // si au moins 1 résultat
    if(mysqli_num_rows($recup)){
        // on utilise le fetch all car il peut y avoir plus d'un résultat
        return mysqli_fetch_all($recup,MYSQLI_ASSOC);
    }
    // no result
    return false;
}

// LOAD full article with ID
function articleLoadFull($connect,$id){
    $id = (int) $id;
    $req = "SELECT * FROM articles a 
	INNER JOIN users u 
		ON a.users_idusers = u.idusers
    WHERE a.idarticles=$id";
    $recup = mysqli_query($connect,$req);
    // si on a 1 résultat
    if(mysqli_num_rows($recup)){
        // on utilise le fetch all car il peut y avoir plus d'un résultat
        return mysqli_fetch_assoc($recup);
    }
    // no result
    return false;
}

// insertion d'un nouvel article
function insertArticle($c,$title,$text,$id){
    $sql="INSERT INTO articles (titre,texte,users_idusers) VALUES ('$title','$text',$id);";
    $request = mysqli_query($c,$sql);
    return ($request)?true:false;
}