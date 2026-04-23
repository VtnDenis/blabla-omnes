<?php
session_start();

include("traitementPreferences.php");
include("../partials/header.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préférences</title>
    <link rel="stylesheet" href="preferences.css">
    <script src="js/preferences.js"></script>
</head>

<body>
    <div class="bloc">
        <span class="flex justify-center pt-20 pb-10 text-black font-manrope text-3xl">Définissez vos préférences</span>
        <form method="post" action="" onsubmit="return validateForm()">

            <div class="bloc-formulaire">
                <div class="partie">
                    <!-- Préférence pour fumer -->
                    <label for="fumer">Fumer :</label>
                    <select id="fumer" name="fumer">
                        <option value="">-- Choisir une option --</option>
                        <option value="oui">Oui</option>
                        <option value="peutetre">Peut-être</option>
                        <option value="non">Non</option>
                    </select>
                    <br>
                </div>
                <div class="partie">
                    <!-- Préférence pour discussion -->
                    <label for="discussion">Discussion :</label>
                    <select id="discussion" name="discussion">
                        <option value="">-- Choisir une option --</option>
                        <option value="oui">Oui</option>
                        <option value="peutetre">Peut-être</option>
                        <option value="non">Non</option>
                    </select>
                    <br>
                </div>
                <div class="partie">
                    <!-- Préférence pour musique -->
                    <label for="musique">Musique :</label>
                    <select id="musique" name="musique">
                        <option value="">-- Choisir une option --</option>
                        <option value="oui">Oui</option>
                        <option value="peutetre">Peut-être</option>
                        <option value="non">Non</option>
                    </select>
                    <br>
                </div>
                <div class="partie">
                    <!-- Préférence pour animaux -->
                    <label for="animaux">Animaux :</label>
                    <select id="animaux" name="animaux">
                        <option value="">-- Choisir une option --</option>
                        <option value="oui">Oui</option>
                        <option value="peutetre">Peut-être</option>
                        <option value="non">Non</option>
                    </select>
                    <br>
                </div>
                <div class="bouton">
                    <button type="submit">Enregistrer</button>
                </div>
            </div>

        </form>
    </div>


    <?php include("../partials/footer.php"); ?>

</body>

</html>