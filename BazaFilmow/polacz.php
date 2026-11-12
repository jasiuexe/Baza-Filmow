<?php
$polaczenie = mysqli_connect("localhost", "root", "", "baza_filmow");

if (!$polaczenie) {
    die("Nie można połączyć się z bazą danych.");
}

mysqli_set_charset($polaczenie, "utf8");
?>