<?php
session_start();
include("../connexion_bdd.php");
require_once '../includes/auth.php';
requireAdmin();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT pe.id, pe.num, pe.date, pe.valide, pe.photo_permis, p.nom, p.prenom
FROM profil p, permis pe
WHERE p.id = pe.id_profil";

    $index = 0;

    if (!empty(trim($_POST['nom'])) || !empty(trim($_POST['prenom'])) || !empty(trim($_POST['date'])) || $_POST['statut'] != -1) {

        $sql = $sql . " AND ";

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

        if($_POST['statut'] != -1){
            $statut = $_POST['statut'];

            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $sql = $sql . " pe.valide = :statut ";

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
    if ($_POST['statut'] != -1) {
        $stmt->bindParam(':statut', $statut);
    }

    $stmt->execute();

    $results = $stmt->fetchAll();

    echo count($results) . " résultats trouvés";

    echo "<table>
                        <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody>";

    foreach ($results as $result) {
        $statut = $result['valide'];
        if($statut == 1) {
            $statut = "Validé";
            $statut_css = "completed";
        }
        else if ($statut == 0) {
            $statut = "En attente";
            $statut_css = "processing";
        }
        else {
            $statut = "Refusé";
            $statut_css = "refused";
        }

        echo "
                        <tr>
                            <td>
                                <i class='fa-solid fa-user'></i>
                                <p>" . htmlspecialchars($result['prenom']) . " " . htmlspecialchars($result['nom']) . "</p>
                            </td>
                            <td>" . htmlspecialchars($result['date']) . "</td>
                            <td><span class='status ".$statut_css."'>".$statut."</span></td>
                            <td><a href='gestionPermisDetails.php?id_permis=".$result['id']."'><button type='submit'>Voir</button></a></td>
                        </tr>";
    }
    echo "</tbody>
                    </table>";
}