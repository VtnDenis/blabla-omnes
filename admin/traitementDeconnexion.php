<?php
session_start();
session_unset();
session_destroy();
setcookie("profil_id", "", time() - 3600, "/");
header("Location: ../compte/compte.php");
exit();