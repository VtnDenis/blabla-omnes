<?php
session_start();
include("../connexion_bdd.php");
require_once '../includes/auth.php';
requireAdmin();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT p.id, s.id_profil, s.id_plainte, p.nom, p.prenom, p.date_inscription
FROM profil p, signale s, plainte pl
WHERE p.id = s.id_profil AND pl.id = s.id_plainte";

    $index = 0;

    $statutSelection = $_POST['statut'] ?? 'toutes';

    if (!empty(trim($_POST['nom'])) || !empty(trim($_POST['prenom'])) || !empty(trim($_POST['date'])) || $statutSelection !== 'toutes') {

        $sql = $sql . " AND ";

        if (!empty(trim($_POST['prenom']))) {
            $prenom = $_POST['prenom'];
            $prenomPattern = '%' . $prenom . '%';

            $sql = $sql . " p.prenom LIKE :prenomPattern ";

            $index = 1;
        }

        if ($statutSelection !== 'toutes') {
            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $statutValue = 0;
            if ($statutSelection === 'en_cours') {
                $statutValue = 1;
            } else if ($statutSelection === 'traitees') {
                $statutValue = 2;
            }

            $sql = $sql . " pl.statut = :statutValue ";
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
    if ($statutSelection !== 'toutes') {
        $stmt->bindParam(':statutValue', $statutValue, PDO::PARAM_INT);
    }

    $stmt->execute();

    $results = $stmt->fetchAll();

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
        $sql = "SELECT statut FROM plainte WHERE id = :id_plainte";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_plainte', $result['id_plainte']);
        $stmt->execute();
        $statut = $stmt->fetch();
        $statut_css = "";
        if($statut['statut'] == 0) {
            $statut = "Nouveau";
            $statut_css = "pending";
        }
        else if ($statut['statut'] == 1) {
            $statut = "En attente";
            $statut_css = "processing";
        }
        else if ($statut['statut'] == 2) {
            $statut = "Résolu";
            $statut_css = "completed";
        }
        echo "
                        <tr>
                            <td>
                                <i class='fa-solid fa-user'></i>
                                <p>" . htmlspecialchars($result['prenom']) . " " . htmlspecialchars($result['nom']) . "</p>
                            </td>
                            <td>" . htmlspecialchars($result['date_inscription']) . "</td>
                            <td><span class='status ".$statut_css."'>".$statut."</span></td>
                            <td><a href='gestionPlainteDetails.php?id_plainte=".$result['id_plainte']."'><button type='submit'>Voir</button></a></td>
                        </tr>";
    }
    echo "</tbody>
                    </table>";
}