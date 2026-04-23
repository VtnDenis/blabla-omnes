<?php include("traitementDefenseSignaler.php");?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Écrire une défense</title>
    <link rel="stylesheet" href="css/defenseSignaler.css">
</head>
<body>
<div class="container">
    <h1>Écrire une défense</h1>
    <div>Raison de la plainte : <?php

        $sql = "SELECT raison FROM plainte WHERE id = :id_plainte";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(":id_plainte", $_GET['id_plainte']);
        $stmt->execute();
        $plainte = $stmt->fetch()['raison'];
        echo $plainte;
        ?></div>
    <form method="post">
        <label for="defense">Votre défense :</label>
        <textarea id="defense" name="defense" placeholder="Décrivez votre version des faits..." required></textarea>

        <input type="submit" value="Envoyer la défense">
    </form>
</div>
</body>
</html>
