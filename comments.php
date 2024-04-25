<?php

function chargerClasse($classname){
    require "manager".'.php';
    require "comment.php";   
}
if (isset($_POST['publier'])){
spl_autoload_register('chargerClasse');

$con=new PDO('mysql:host=localhost;dbname=ds2','root','');
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);


    $manager=new manager($con);
    $username=$_GET["username"];
    $a=$_GET["id_arti"];

    if (isset($_POST["com"])){
        $comment=new comment(array('user' =>$username,'contenu'=>$_POST["com"],'article'=>$a));
        $manager->ajoutercomment($comment);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zone de commentaires</title>
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000080; 
            color: #fff;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            position: relative; 
            z-index: 1; 
        }

        #video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%; 
            min-height: 100%;
            width: auto; 
            height: auto;
            z-index: -1; 
            object-fit: cover; 
        }

        .comment-box {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); 
        }

        .comment-box textarea {
            width: 100%;
            height: 100px;
            resize: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .comment-box button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .comment-box button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <video id="video-background" autoplay muted loop>
        <source src="ar.mp4" type="video/mp4">
    </video>

    <div class="container">
        <div class="comment-box">
        <h2 class="h4 font-weight-bold font-weight-normal">Commentaires</h2>



            <div>
    <?php
    spl_autoload_register('chargerClasse');
    $con = new PDO('mysql:host=localhost;dbname=ds2', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $manager = new manager($con);
    $comments = $manager->getAllComments();
    foreach ($comments as $comment) {
        echo "<div class='comment'>";
        echo "<b class='text-success'>" . $comment->getUser() . "</b>: <span class='text-dark'>" . $comment->getContenu() . "</span>";
        echo "<br>";
        echo "</div>";
    }
    ?>
</div>

            <form action="" method="post">
                <textarea class="form-control" placeholder="Écrivez votre commentaire ici..." name="com" id="com"></textarea>
                <button class="btn btn-danger mt-3" type="submit" name="publier" id="publier" style="background-color: red !important;">Publier</button>


            </form>
        </div>
    </div>
</body>
</html>
