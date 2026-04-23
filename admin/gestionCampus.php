<?php
require_once '../connexion_bdd.php';
require_once '../includes/auth.php';
requireAdmin();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>Admin page</title>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <a href="admin.php" class="logo">
        <img src="..\img\logo_blabla_omnes.png" alt="logo" style="width: 100%; height: auto; max-width: 200px; display: block; margin: auto;">
    </a>
    <ul class="side-menu">
        <li><a href="admin.php"><i class='bx bxs-dashboard'></i>Tableau de bord</a></li>
        <li><a href="gestionProfil.php"><i class='bx bx-message-square-dots'></i>Gestion Profil</a></li>
        <li><a href="gestionPermis.php"><i class='bx bxs-id-card'></i>Gestion Permis</a></li>
        <li><a href="gestionPlaintes.php"><i class='bx bxs-flag-alt'></i>Gestion Plaintes</a></li>
        <li><a href="gestionCampus.php"><i class='bx bx-store-alt'></i>Gestion Campus</a></li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="traitementDeconnexion.php" class="logout">
                <i class='bx bx-log-out-circle'></i>
                Déconnexion
            </a>
        </li>
    </ul>
</div>
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <nav>
        <i class='bx bx-menu'></i>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </form>

        <a href="#" class="profile">
            <i class="fa-solid fa-user"></i>
        </a>
    </nav>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Gestion des Campus</h1>
            </div>
        </div>

        <div class="campus-management">
            <form id="campus-form">
                <div class="form-group">
                    <label for="campus-name">Nom du Campus:</label>
                    <input type="text" id="campus-name" name="campus-name" required>
                </div>
                <div class="form-buttons">
                    <button type="button" onclick="addCampus()">Ajouter</button>
                    <button type="button" onclick="deleteCampus()">Supprimer</button>
                    <button type="button" onclick="editCampus()">Modifier</button>
                </div>
            </form>
            <div class="form-input search-campus">
                <input type="search" id="search-campus" placeholder="Rechercher un campus...">
                <button class="search-btn" type="button" onclick="searchCampus()"><i class='bx bx-search'></i></button>
            </div>
        </div>

        <!-- Insights -->
        <ul class="insights">
            <li>
                <i class='bx bx-plus' ></i>
                <span class="info">
                        <h3>...</h3>
                        <p>Ajout Campus</p>
                    </span>
            </li>
            <li><i class='bx bx-trash'></i>
                <span class="info">
                        <h3>...</h3>
                        <p>Campus supprimé</p>
                    </span>
            </li>
            <li><i class='bx bx-edit' ></i>
                <span class="info">
                        <h3>...</h3>
                        <p>Modifier Campus</p>
                    </span>
            </li>
        </ul>

    </main>
</div>

<script src="js/admin.js"></script>

</body>
</html>
