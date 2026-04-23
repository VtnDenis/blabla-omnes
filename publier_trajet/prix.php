<?php
    include("traitementPrix.php");
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
    <title>Prix</title>
</head>
<body>
<h1 class="text">Fixez votre prix par place</h1>
<br>
<form method="post">

    <div class="centre">
    <input type="number" placeholder="Prix" name="prix" min="1" max="200" required>

    </div>
    
    <div class="bouton">
        <button type="submit">Soumettre</button>
    </div>

</form>

</body>
</html>