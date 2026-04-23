<?php include("traitementDemandeVerifPermis.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="publier_trajet.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
<div class="centre">
    <form method="post" enctype='multipart/form-data'>
        <h1 class="text">Vérification de votre permis</h1>
        <label>Numéro du permis</label>
        <input type="text" name="num" required><br>
        <label>Date d'expiration</label>
        <select name="exp_month" required>
            <option value="01">Janvier</option>
            <option value="02">Février</option>
            <option value="03">Mars</option>
            <option value="04">Avril</option>
            <option value="05">Mai</option>
            <option value="06">Juin</option>
            <option value="07">Juillet</option>
            <option value="08">Août</option>
            <option value="09">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Décembre</option>
        </select>
        <select name="exp_year" required>
            <!-- Vous pouvez ajouter plus d'années selon vos besoins -->
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
        </select><br>
        <label>Photo de votre permis</label>
        <input type="file" name="photo_permis" required><br>
        <button type="submit">Valider</button>
    </form>
</div>

</body>
</html>
