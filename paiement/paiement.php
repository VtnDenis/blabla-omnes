<?php include("traitementPaiement.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paiement.css">
    <title>Paiement</title>
</head>
<body>
    <div class="tout">
        <div class="secure">
            <div class="secure-object"><img id="cadenas" src="../img/paiements/345535.png" alt="cadenas"></div>
            <div class="secure-object"><p class="text">Paiement sécurisé avec </p></div>
            <div class="secure-object"><img id="cb" src="../img/paiements/logo-cb.jpg" alt="cb"></div>
            <div class="secure-object"><img id="mastercard" src="../img/paiements/MasterCard-Logo-1-1024x768.png" alt="mastercard"></div>
            <div class="secure-object"><img id="visa" src="../img/paiements/ancien-logo-visa-1-1024x389.png" alt="visa"></div>
        </div>
        
        <br>
        <form method="post">

            <div class="centre">
                <div class="colonne">
                    <input type="text" placeholder="Numéro de carte" name="num" pattern="\d{16}" required>
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
                </div>
                <div class="colonne">
                    <input type="text" placeholder="Titulaire de la carte" name="nom" required>
                    <input pattern="\d{3}" type="number" placeholder="Cryptogramme" name="crypto" required>
                </div>

            </div>

            <div class="ligne">
                <div class="date"><p class="text-date"><?php echo date("d/m/y")?></p></div>
                <div class="profile">
                    <img id="photo-profile" src="../img/pngegg (5).png" alt="photo-profile">
                    <p class="text-profile">
                        <?php
                            include("../connexion_bdd.php");
                            global $bdd;
                            $sql = "SELECT prenom, nom FROM profil WHERE id = :id";
                            $stmt = $bdd->prepare($sql);
                            $stmt->bindParam(':id', $_COOKIE['profil_id']);
                            $stmt->execute();
                            $profil = $stmt->fetch();
                            echo htmlspecialchars($profil['prenom'])." ". htmlspecialchars($profil['nom']);
                        ?>
                    </p>

                </div>
                <div class="prix"><p class="text-date"><?php
                    $sql = "SELECT prix FROM trajet WHERE id = :id";
                    $stmt = $bdd->prepare($sql);
                    $stmt->bindParam(':id', $_GET['id_trajet']);
                    $stmt->execute();
                    echo $stmt->fetch()['prix']*$_GET['nb_passagers']." €"; // ATTENTION : Multiplier par le nb passagers
                        ?></p></div>
            </div>
            <div class="bouton">
                <button type="submit">Payer</button>
            </div>
            
        </form>


    </div>
    
</body>
</html>