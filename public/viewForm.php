<?php
$msg = isset($msg) ? $msg : "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forma za unos podataka</title>
</head>
<body>
    <h2>Unesite vaše podatke:</h2>
    <form action="" method="post">
        <label for="brRadnika">Broj Radnika:</label>
        <input type="text" id="brRadnika" name="brRadnika"><br><br>

        <label for="trajanjePrisustva">Trajanje Prisustva:</label>
        <input type="text" id="trajanjePrisustva" name="trajanjePrisustva"><br><br>

        <input type="submit" name="action" value="insertAndCalculateMinPrisustvo">
    </form>
</body>
</html>
