<?php
session_start();

if (!isset($_SESSION['racunar'])) {
    header("Location: index.php");
    exit;
}

$racunar = $_SESSION['racunar'];

require 'RacunarDAO.php';
require 'db_connection.php'; // Assuming this file sets up $conn

$dao = new RacunarDAO($conn);
$najskuplji = $dao->getNajskuplji();
$najjeftiniji = $dao->getNajjeftiniji();

$razlika = $najskuplji['cena'] - $najjeftiniji['cena'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikaz Racunara</title>
</head>
<body>
    <h1>Detalji o Racunaru</h1>
    <p>ID: <?php echo htmlspecialchars($racunar['id']); ?></p>
    <p>Marka: <?php echo htmlspecialchars($racunar['marka']); ?></p>
    <p>Cena: <?php echo htmlspecialchars($racunar['cena']); ?></p>

    <?php if ($najskuplji && $najjeftiniji): ?>
        <p>Razlika cene između najskupljeg i najjeftinijeg racunara: <?php echo htmlspecialchars($razlika); ?></p>
    <?php endif; ?>

    <a href="controller.php?logout=true">Logout</a>
</body>
</html>
