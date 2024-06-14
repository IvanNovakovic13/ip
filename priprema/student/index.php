<?php
session_start();
require 'RacunarDAO.php';
require 'db_connection.php'; // Assuming this file sets up $conn

$dao = new RacunarDAO($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

    if ($id !== null) {
        $racunar = $dao->getRacunarId($id);

        if ($racunar !== null) {
            $_SESSION['racunar'] = $racunar;
            header("Location: prikaz.php");
            exit;
        } else {
            $_SESSION['error'] = "Racunar not found";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Invalid ID";
        header("Location: index.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
