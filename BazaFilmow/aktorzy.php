<?php
include "polacz.php";
$sql = "SELECT * FROM aktorzy";
$wynik = mysqli_query($polaczenie, $sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Aktorzy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Aktorzy</h1>
    <nav><a href="index.php">Powrót do filmów</a></nav>
</header>
<main>
    <h2>Lista aktorów</h2>
    <?php while ($aktor = mysqli_fetch_assoc($wynik)) { ?>
        <div class="film">
            <p><?php echo htmlspecialchars($aktor["imie"] . " " . $aktor["nazwisko"]); ?></p>
        </div>
    <?php } ?>
</main>
</body>
</html>