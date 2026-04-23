<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil_consultant = requireAuth();

include("modifier.php");
include("../partials/header.php");

if(isset($_GET['id_profil'])){
    $id_profil = (int) $_GET['id_profil'];
}
else{
    $id_profil = $id_profil_consultant;
}

global $bdd;

$sql = "SELECT type FROM profil WHERE id = :id_profil_consultant";

$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil_consultant', $id_profil_consultant);
$stmt->execute();

$type = $stmt->fetch()['type'];

$sql = "SELECT * FROM profil WHERE id = :id_profil";

$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil', $id_profil);
$stmt->execute();

$profil = $stmt->fetch();

if(empty(trim($profil['pdp']))){
    $profil['pdp'] = "../img/pngegg (5).png";
}

echo "<div class='gros-bloc'>
            <div class='bloc-infos'>
                <img class='photo-profile' src='".$profil['pdp']."' alt='profile'>
                <div class='texte-couleur-omnes'>
                    <form method='post'>
                        <button name='pdp' class='text-1xl font-medium underline text-center'>Modifier</button>
                    </form>
                </div>

                <p class='text-2xl font-semibold leading-normal text-center '>".htmlspecialchars($profil['prenom'])." ".htmlspecialchars($profil['nom'])."</p>

                <div class='liste-infos-utilisateur'>

                    <div class='champ-prenom'>

                        <div class='partie-droite-du-champ'>
                            <span class='text-black text-1xl font-semibold'>Prénom :</span>

                            <span class='text-grey text-1xl font-semibold'>".htmlspecialchars($profil['prenom'])."</span>

                        </div>

                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='prenom' type='submit' class='text-1xl font-medium underline text-right'>Modifier</button>
                            </form>  
                         </div>

                    </div>

                    <div class='champ-prenom'>

                        <div class='partie-droite-du-champ'>
                            <span class='text-black text-1xl font-semibold'>Nom :</span>

                            <span class='text-grey text-1xl font-semibold'>".htmlspecialchars($profil['nom'])."</span>

                        </div>


                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='nom' type='submit' class='text-1xl font-medium underline text-right'>Modifier</button>
                            </form> 
                        </div>

                    </div>

                    <div class='champ-prenom'>

                        <div class='partie-droite-du-champ'>
                            <span class='text-black text-1xl font-semibold'>E-mail :</span>

                            <span class='text-grey text-1xl font-semibold'>".htmlspecialchars($profil['email'])."</span>

                        </div>


                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='email' type='submit' class='text-1xl font-medium underline text-right'>Modifier</button>
                            </form> 
                        </div>

                    </div>

                    <div class='champ-prenom'>

                        <div class='partie-droite-du-champ'>
                            <span class='text-black text-1xl font-semibold'>Date de naissance :</span>

                            <span class='text-grey text-1xl font-semibold'>".$profil['date_naissance']."</span>

                        </div>


                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='date_naissance' type='submit' class='text-1xl font-medium underline text-right'>Modifier</button>
                            </form> 
                        </div>

                    </div>

                    <div class='champ-prenom'>

                        <div class='partie-droite-du-champ'>
                            <span class='text-black text-1xl font-semibold'>Mot de passe :</span>

                            <span class='text-grey text-1xl font-semibold'>*********</span>

                        </div>


                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='mdp' type='submit' class='text-1xl font-medium underline text-right'>Modifier</button></form> 
                        </div></div>";

echo "<div class='champ-prenom'>
                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='preference' type='submit' class='text-blue-600 text-1xl font-medium underline text-right'>Modifier préférence</button>
                            </form> 
                        </div>

                    </div>";

if($type == 1){

    if($profil['type'] == 1){
        $profil_type = "Administrateur";
    }
    else{
        $profil_type = "Utilisateur";
    }


    echo "<div class='champ-prenom'>

                        <div class='partie-droite-du-champ'>
                            <span class='text-black text-1xl font-semibold'>Permissions :</span>

                            <span class='text-grey text-1xl font-semibold'>".$profil_type."</span>

                        </div>


                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='profil_type' type='submit' class='text-1xl font-medium underline text-right'>Modifier</button>
                            </form> 
                        </div>

                    </div>";
}
else{
    echo "<div class='champ-prenom'>
                        <div class='texte-couleur-omnes'>
                            <form method='post'>
                                <button name='deconnexion' type='submit' class='text-red-600 text-1xl font-medium underline text-right'>Deconnexion</button>
                            </form> 
                        </div>

                    </div>";
}

  echo  "                    

                </div>

            </div>




        </div>";