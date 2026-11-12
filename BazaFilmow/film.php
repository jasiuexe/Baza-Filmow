<?php
include "polacz.php";

$id = (int) $_GET["id"];
$sql = "SELECT * FROM filmy WHERE id = $id";
$wynik = mysqli_query($polaczenie, $sql);
$film = mysqli_fetch_assoc($wynik);

if (!$film) {
    die("Nie znaleziono filmu.");
}

if (isset($_POST["dodaj"])) {
    $autor = mysqli_real_escape_string($polaczenie, $_POST["autor"]);
    $ocena = (int) $_POST["ocena"];
    $tresc = mysqli_real_escape_string($polaczenie, $_POST["tresc"]);

    if ($autor != "" && $tresc != "" && $ocena >= 1 && $ocena <= 10) {
        $sql = "INSERT INTO recenzje (film_id, autor, ocena, tresc)
                VALUES ($id, '$autor', $ocena, '$tresc')";
        mysqli_query($polaczenie, $sql);
        header("Location: film.php?id=$id");
        exit;
    } else {
        $blad = "Wypełnij wszystkie pola. Ocena musi być od 1 do 10.";
    }
}

$sql = "SELECT aktorzy.imie, aktorzy.nazwisko, obsada.rola
        FROM aktorzy
        JOIN obsada ON aktorzy.id = obsada.aktor_id
        WHERE obsada.film_id = $id";
$aktorzy = mysqli_query($polaczenie, $sql);

$sql = "SELECT * FROM recenzje WHERE film_id = $id";
$recenzje = mysqli_query($polaczenie, $sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($film["tytul"]); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Baza filmów</h1>
    <nav><a href="index.php">Powrót do filmów</a></nav>
</header>
<main>
    <h2><?php echo htmlspecialchars($film["tytul"]); ?></h2>
    <p>Rok: <?php echo $film["rok"]; ?></p>
    <p>Gatunek: <?php echo htmlspecialchars($film["gatunek"]); ?></p>
    <p><?php echo htmlspecialchars($film["opis"]); ?></p>

    <h3>Aktorzy</h3>
    <?php while ($aktor = mysqli_fetch_assoc($aktorzy)) { ?>
        <p><?php echo htmlspecialchars($aktor["imie"] . " " . $aktor["nazwisko"]); ?>
        — <?php echo htmlspecialchars($aktor["rola"]); ?></p>
    <?php } ?>

    <h3>Recenzje</h3>
    <?php while ($recenzja = mysqli_fetch_assoc($recenzje)) { ?>
        <div class="film">
            <b><?php echo htmlspecialchars($recenzja["autor"]); ?></b>
            <p>Ocena: <?php echo $recenzja["ocena"]; ?>/10</p>
            <p><?php echo htmlspecialchars($recenzja["tresc"]); ?></p>
        </div>
    <?php } ?>

    <h3>Dodaj recenzję</h3>
    <?php if (isset($blad)) echo "<p>$blad</p>"; ?>
    <form method="post">
        <label>Imię: <input type="text" name="autor" required></label><br><br>
        <label>Ocena:
            <select name="ocena">
                <?php for ($i = 1; $i <= 10; $i++) echo "<option>$i</option>"; ?>
            </select>
        </label><br><br>
        <label>Recenzja:<br><textarea name="tresc" required></textarea></label><br><br>
        <button type="submit" name="dodaj">Dodaj</button>
    </form>
</main>
</body>
</html>