<?php
function chargerClasse($classname){
    require "manager".'.php';
    require "article.php";   
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['envoyer'])){
spl_autoload_register('chargerClasse');

$con=new PDO('mysql:host=localhost;dbname=ds2','root','');
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);


    $manager=new manager($con);
    $username=$_GET["username"];
    if (isset($_POST["titre"]) && isset($_POST["contenu"])){
        $article=new article(array('titre' =>$_POST["titre"],'contenu'=>$_POST["contenu"],'username'=>$username));
        $manager->ajouterarticle($article);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diviser en 3 parties</title>
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #fff; 
            margin: 0;
            padding: 0;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr; 
            grid-gap: 20px; 
            padding: 20px;
            margin: auto;
            max-width: 1200px;
            background-color: transparent;
            position: relative;
            z-index: 1; 
        }

        .partie1, .partie2, .partie3 {
            padding: 20px;
            border: 1px solid #ccc;
            background-color: rgba(0, 0, 0, 0.7); 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            z-index: 2; 
        }

        .partie3 form {
            background-color: #f9f9f9; 
            padding: 20px;
            border-radius: 8px;
            color: #000; 
        }

        .partie3 input[type="text"],
        .partie3 textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: #000; 
        }

        

        .align-right {
            text-align: right; 
        }

        h1, h2, h3, h4, h5, h6 {
            color: #fff; 
        }

        a {
            color: #C0392B; 
        }

        video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1; 
        }
    </style>
</head>
<body>
<video autoplay loop muted>
  <source src="ar.mp4" type="video/mp4">
</video>
<div class="container">
    <div class="partie1">
        <h1>Bienvenue sur notre site de blog</h1>
        <p>Ce site est dédié à partager des articles sur la Palestine.</p>
    </div>
    <div class="partie2">
        <?php
        spl_autoload_register('chargerClasse');

        $con=new PDO('mysql:host=localhost;dbname=ds2','root','');
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        // Afficher les articles existants depuis la base de données
        $manager = new manager($con);
        $articles = $manager->getAllArticles();
        foreach ($articles as $article) {
            echo "<div class='article'>";
            
    echo "<h4 class='display-4 text-success'>" . $article->getTitre() . "</h4>";
    echo "<h3><u><span class='text-xs'>[" . $article->getUsername() . "]</span></u></h3>";
    echo "<p class='lead font-weight-light'>" . $article->getContenu() . "</p>";  


            echo "<div class='align-right'><a href='comments.php?id_arti=" . $article->getId() . "&username=" . urlencode($_GET["username"]) . "'>voir les commentaires</a></div>";
            echo "<hr><br></div>";
        }
        ?>
    </div>
    <div class="partie3">
        <h2>Publier un article</h2>
        <form action="#" method="post">
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre">
            <label for="contenu">Contenu :</label>
            <textarea name="contenu" id="contenu" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" value="Publier" name="envoyer" class="btn btn-danger mt-3">
<input type="reset" value="Effacer" class="btn btn-danger mt-3">

        </form>
    </div>
</div>
</body>
</html>
 


