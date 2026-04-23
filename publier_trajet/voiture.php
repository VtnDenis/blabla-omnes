<?php
    include("traitementVoiture.php");
include("../partials/header.php");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="publier_trajet.css">
    <title>Document</title>
</head>
<body>
    <h1 class="text">Ma voiture</h1>
    <br>
    <form method="post" enctype="multipart/form-data">

    <div class="tout">
        <div class="centre">
            <input type="text" placeholder="Marque" name="marque" required>
            <input type="text" placeholder="Modèle" name="modele" required>
            <input type="text" placeholder="Numéro de plaque" name="num_plaque" required>
        </div>

        
        <br/>
        <div class="ligne">
            <p class="text2">Photo de la voiture (facultatif) :</p>
            <div class="centre">
            <input type="file" name="photoVoiture" id="photoVoiture">
            </div>
            
            
            <div class="bouton">
                <button type="submit">Soumettre</button>
            </div>

        </div>
    </div>
            
        
        
    </form>
</body>
</html>