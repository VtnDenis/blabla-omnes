<?php
date_default_timezone_set('Europe/Paris');
session_start();
if(isset($_SESSION['connecte']) && $_SESSION['connecte'] == 0){
    setcookie("profil_id", "", time() - 3600,"/");
    unset($_COOKIE['profil_id']);
    $_SESSION['connecte'] = 1;
}
include("../partials/header.php");
include("traitementInscription.php");
include("traitementConnexion.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../login.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>

<body>
    <!-- Conteneur principal -->
    <div class="container">
        <!-- Conteneur des formulaires -->
        <div class="forms-container">
            <!-- Div pour la connexion et l'inscription -->
            <div class="signin-signup">
                <!-- Formulaire de connexion -->
                <form class="sign-in-form" method="post">
                    <h2 class="title">Se connecter</h2>
                    <!-- Champ pour le nom d'utilisateur -->
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Email" name="email" required />
                    </div>
                    <!-- Champ pour le mot de passe -->
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mot de passe" name="password" required />
                    </div>
                    <!-- Option pour se souvenir de la session -->
                    <form method="post">
                        <div class="remember-me">
                            <input type="checkbox" name="rememberMe">
                            <label for="rememberMe">Se souvenir de moi</label>
                        </div>
                        <!-- Bouton de connexion -->
                        <button type="submit" class="btn">Se connecter</button>
                    </form>
                </form>
                <!-- Formulaire d'inscription -->
                <form class="sign-up-form" method="post">
                    <h2 class="title">S'inscrire</h2>
                    <!-- Champ pour le nom d'utilisateur -->
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Prénom" name="name" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nom" name="surname" required/>
                    </div>
                    <!-- Champ pour l'adresse email -->
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email_register" required/>
                    </div>
                    <!-- Champ pour le numéro de téléphone -->
                    <div class="input-field">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" placeholder="Téléphone" name="phone" required/>
                    </div>
                    <!-- Champ pour le mot de passe -->
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mot de passe" name="password_register" required/>
                    </div>
                    <!-- Champ pour la date de naissance -->
                    <div class="input-field">
                        <i class="fa-solid fa-cake-candles"></i>
                        <input type="date" placeholder="Jour de naissance" name="birthdate" required/>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit" class="btn">S'inscrire</button>
                </form>
            </div>
        </div>

        <!-- Conteneur des panneaux -->
        <div class="panels-container">
            <!-- Panneau gauche -->
            <div class="panel left-panel">
                <div class="content">
                    <h3>Nouveau parmi nous ?</h3>
                    <p>
                        Marre des trajets en solitaire et des frais de transport exorbitants ? Avec Blabla Omnes, simplifiez
                        vos déplacements tout en faisant des économies !
                    </p>
                    <!-- Bouton pour afficher le formulaire d'inscription -->
                    <button class="btn transparent" id="sign-up-btn">
                        S'inscrire
                    </button>
                </div>
                <!-- Image pour le panneau gauche -->
                <img src="../img/order_ride.svg" class="image" alt="" />
            </div>
            <!-- Panneau droit -->
            <div class="panel right-panel">
                <div class="content">
                    <h3>On se connait ?</h3>
                    <p>
                        Rencontrez des personnes sympas et partagez des moments agréables en chemin.
                    </p>
                    <!-- Bouton pour afficher le formulaire de connexion -->
                    <button class="btn transparent" id="sign-in-btn">
                        Se connecter
                    </button>
                </div>
                <!-- Image pour le panneau droit -->
                <img src="../img/delivery_truck.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="../login.js"></script>

    <?php
    include("../partials/footer.php");
    ?>
</body>

</html>