<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Verify the current user is authenticated.
 * Returns their profile ID or redirects to login.
 */
function requireAuth(): int {
    if (empty($_SESSION['profil_id'])) {
        header('Location: /compte/compte.php');
        exit();
    }
    return (int) $_SESSION['profil_id'];
}

/**
 * Verify the current user is an admin (type = 1).
 * Requires $GLOBALS['bdd'] to be set (connexion_bdd.php included first).
 */
function requireAdmin(): void {
    $id = requireAuth();
    $bdd = $GLOBALS['bdd'];
    $stmt = $bdd->prepare('SELECT type FROM profil WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    if (!$row || (int) $row['type'] !== 1) {
        http_response_code(403);
        header('Location: /compte/compte.php');
        exit();
    }
}
