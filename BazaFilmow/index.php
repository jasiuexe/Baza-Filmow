<?php
include "polacz.php";

$sql = "SELECT * FROM filmy";
$wynik = mysqli_query($polaczenie, $sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Baza filmów</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Baza filmów</h1>
    <nav>
        <a href="index.php">Filmy</a>
        <a href="aktorzy.php">Aktorzy</a>
    </nav>
</header>
<main>
    <h2>Lista filmów</h2>
    <?php while ($film = mysqli_fetch_assoc($wynik)) { ?>
        <div class="film">
            <h3><?php echo htmlspecialchars($film["tytul"]); ?></h3>
            <p>Rok: <?php echo $film["rok"]; ?></p>
            <p>Gatunek: <?php echo htmlspecialchars($film["gatunek"]); ?></p>
            <a href="film.php?id=<?php echo $film["id"]; ?>">Zobacz szczegóły</a>
        </div>
    <?php } ?>
</main>
</body>
</html>