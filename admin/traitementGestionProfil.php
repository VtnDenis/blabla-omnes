<?php
session_start();
include("../connexion_bdd.php");
require_once '../includes/auth.php';
requireAdmin();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT * FROM profil p";

    $index = 0;

    if (!empty(trim($_POST['nom'])) || !empty(trim($_POST['prenom'])) || !empty(trim($_POST['date'])) || $_POST['role'] != -1) {

        $sql = $sql . " WHERE ";

        if (!empty(trim($_POST['prenom']))) {
            $prenom = $_POST['prenom'];
            $prenomPattern = '%' . $prenom . '%';

            $sql = $sql . " p.prenom LIKE :prenomPattern ";

            $index = 1;
        }

        if (!empty(trim($_POST['nom']))) {
            $nom = $_POST['nom'];
            $nomPattern = '%' . $nom . '%';

            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $sql = $sql . " p.nom LIKE :nomPattern ";

            $index = 1;
        }

        if (!empty(trim($_POST['date']))) {
            $date = $_POST['date'];

            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $sql = $sql . " p.date_inscription = :date ";

            $index = 1;
        }

        if($_POST['role'] != -1){
            $role = $_POST['role'];

            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $sql = $sql . " p.type = :type ";

            $index = 1;
        }


    }

    $stmt = $bdd->prepare($sql);

    if (!empty(trim($_POST['prenom']))) {
        $stmt->bindParam(':prenomPattern', $prenomPattern, PDO::PARAM_STR);
    }
    if (!empty(trim($_POST['nom']))) {
        $stmt->bindParam(':nomPattern', $nomPattern, PDO::PARAM_STR);
    }
    if (!empty(trim($_POST['date']))) {
        $stmt->bindParam(':date', $date);
    }
    if ($_POST['role'] != -1) {
        $stmt->bindParam(':type', $role);
    }

    $stmt->execute();

    $results = $stmt->fetchAll();

    echo $stmt->rowCount() . " résultats trouvés";

    echo "<table>
                        <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Date inscription</th>
                            <th>Rôle</th>
                            
                        </tr>
                        </thead>
                        <tbody>";

    foreach ($results as $result) {

        if($result['type']==1){
            $type = "Administrateur";
        }
        else if($result['type'] == 0){
            $type = "Utilisateur";
        }
        else{
            $type = "Inconnu";
        }
        echo "
                        <tr>
                            <td>
                                <i class='fa-solid fa-user'></i>
                                <p>" . htmlspecialchars($result['prenom']) . " " . htmlspecialchars($result['nom']) . "</p>
                            </td>
                            <td>" . $result['date_inscription'] . "</td>
                            <td>" . $type . "</td>
                            
                            <td><a target='_blank' href='../profil/info-utilisateur.php?id_profil=". $result['id'] . "'><button type='submit'>Voir</button></a></td>
                        </tr>";
    }
    echo "</tbody>
                    </table>";
}