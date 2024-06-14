<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna Stranica</title>
</head>
<body>
    <h1>Unesi ID Racunara</h1>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']);
    }
    ?>
    <form action="controller.php" method="POST">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
