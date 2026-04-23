<?php include("traitementModifierPermission.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Quelle permission ?</h1>
    <form method="post">
        <label>Permission :</label>
        <select name="permission">
            <option value="1">Administrateur</option>
            <option value="0">Utilisateur</option>
        </select>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>