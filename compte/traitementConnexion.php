<?php
session_start();
include("../connexion_bdd.php");

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        //On essaye de se connecter
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM profil WHERE email = :email";

        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $profil = $stmt->fetch();
            if (!password_verify($password, $profil['password'])) {
                header('Location: ../index.html?error=1');
                exit();
            }
            $_SESSION['profil_id'] = (int) $profil['id'];
            if(isset($_POST['rememberMe'])){
                // On garde la session ouverte pendant un an
                setcookie("profil_id", $profil['id'], time() + 365*24*3600, "/", null, false, true);
            }
            else{
                // On garde la session ouverte jusqu'à la fermeture du navigateur
                setcookie("profil_id", $profil['id'],null,"/");
            }

            if($profil['type']==1){
                //La personne est admin
                header("Location: ../admin/admin.php");
                exit();
            }
            header("Location: ../recherche_trajet/accueil.php");
            exit();
            //Rediriger vers la page d'accueil
        }

        header('Location: ../index.html?error=1');
        exit();


    }
}


