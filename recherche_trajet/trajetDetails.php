<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../recherche_trajet/css/recherche.css">
    <title>Document</title>
</head>
<body>
<?php include("../partials/header.php"); ?>
<div class="bg-gray-100 flex flex-col items-center justify-center pt-[50px] pb-[50px]">
    <?php
    include("traitementTrajetDetails.php");
    ?>
</div>
</body>
</html>