<?php
session_start();


include("../connexion_bdd.php");
require_once '../includes/auth.php';
requireAdmin();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT nom, prenom FROM profil ";

    $index = 0;

    if (!empty(trim($_POST['nom'])) || !empty(trim($_POST['prenom'])) || !empty(trim($_POST['date']))) {

        $sql = $sql . " WHERE ";

        if (!empty(trim($_POST['prenom']))) {
            $prenom = $_POST['prenom'];
            $prenomPattern = '%' . $prenom . '%';

            $sql = $sql . " prenom LIKE :prenomPattern ";

            $index = 1;
        }

        if (!empty(trim($_POST['nom']))) {
            $nom = $_POST['nom'];
            $nomPattern = '%' . $nom . '%';

            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $sql = $sql . " nom LIKE :nomPattern ";

            $index = 1;
        }

        if (!empty(trim($_POST['date']))) {
            $date = $_POST['date'];

            if ($index != 0) {
                $sql = $sql . " AND ";
                $index = 0;
            }

            $sql = $sql . " date_inscription = :date ";

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
        echo "
                        <tr>
                            <td>
                                <i class='fa-solid fa-user'></i>
                                <p>" . htmlspecialchars($result['prenom']) . " " . htmlspecialchars($result['nom']) . "</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class='status completed'>Completed</span></td>
                        </tr>";
    }
    echo "</tbody>
                    </table>";
}