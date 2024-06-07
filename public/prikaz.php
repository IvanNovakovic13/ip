<?php
session_start();

if (isset($_SESSION["korisnik_ime"]) && !empty($_SESSION["korisnik_ime"])) {
    echo "Korisnik ID: " . $_SESSION["korisnik_id"] . "<br>";
    echo "Korisnik Ime: " . $_SESSION["korisnik_ime"] . "<br>";
} elseif (isset($_SESSION['minPrisustvo']) && !empty($_SESSION['minPrisustvo'])) {
    $minPrisustvo = $_SESSION['minPrisustvo'];
    echo "<h1>Radnik sa najmanjim prisustvom</h1>";
    echo "ID: " . htmlspecialchars($minPrisustvo['id']) . "<br>";
    echo "Broj Radnika: " . htmlspecialchars($minPrisustvo['brRadnika']) . "<br>";
    echo "Trajanje Prisustva: " . htmlspecialchars($minPrisustvo['trajanjePrisustva']) . "<br>";
} else {
    header("Location: ../index.php?action=forma");
}
?>
