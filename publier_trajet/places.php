<?php
    include("traitementPlaces.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="publier_trajet.css">
    <title>Nombres de places</title>
</head>
<body>
<?php include("../partials/header.php"); ?>
<h1 class="text">Combien de passagers BlaBlaOmnes pouvez-vous accepter ?</h1>
<form method="post">
    
    <br>
    <div class="centre">
        <input type="number" placeholder="Number of seats" name="places" min="1" max="5" required>
    </div>
    
    <div class="bouton">
        <button type="submit">Soumettre</button>
    </div>
    
</form>

</body>
</html>