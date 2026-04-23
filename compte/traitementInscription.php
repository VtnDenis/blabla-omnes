<?php
session_start();
include("../connexion_bdd.php");

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si c'est une inscription
    if (isset($_POST["email_register"]) && isset($_POST["password_register"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["phone"]) && isset($_POST["birthdate"])) {
        $email_register = $_POST["email_register"];
        $password_register = $_POST["password_register"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $phone = $_POST["phone"];
        $birthdate = $_POST["birthdate"];

        //On vérifie que le mail ou le numéro de téléphone n'existe pas

        $sql = "SELECT * FROM profil WHERE email = :email OR num_tel = :phone;";

        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':email', $email_register);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            //Il existe déjà un compte avec le même numéro de téléphone ou la même adresse mail
            echo "Adresse mail ou numéro de téléphone incorrect(e)";
            exit();
        }

        $_SESSION['email_register'] = $email_register;
        $_SESSION['password_register'] = password_hash($password_register, PASSWORD_BCRYPT);
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['phone'] = $phone;
        $_SESSION['birthdate'] = $birthdate;


        header("Location: preferences.php");
        exit();

    }
}

