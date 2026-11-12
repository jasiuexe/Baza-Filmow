CREATE DATABASE baza_filmow;
USE baza_filmow;

CREATE TABLE filmy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tytul VARCHAR(100) NOT NULL,
    rok INT NOT NULL,
    gatunek VARCHAR(50) NOT NULL,
    opis TEXT
);

CREATE TABLE aktorzy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imie VARCHAR(50) NOT NULL,
    nazwisko VARCHAR(50) NOT NULL
);

CREATE TABLE obsada (
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_id INT,
    aktor_id INT,
    rola VARCHAR(100),
    FOREIGN KEY (film_id) REFERENCES filmy(id),
    FOREIGN KEY (aktor_id) REFERENCES aktorzy(id)
);

CREATE TABLE recenzje (
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_id INT,
    autor VARCHAR(50),
    ocena INT,
    tresc TEXT,
    FOREIGN KEY (film_id) REFERENCES filmy(id)
);

INSERT INTO filmy (tytul, rok, gatunek, opis) VALUES
('Shrek', 2001, 'Animacja', 'Ogr Shrek wyrusza w podróż, aby uratować swoją okolicę.'),
('Titanic', 1997, 'Dramat', 'Historia miłości na pokładzie słynnego statku.'),
('Avatar', 2009, 'Sci-Fi', 'Historia człowieka, który poznaje planetę Pandora.');

INSERT INTO aktorzy (imie, nazwisko) VALUES
('Mike', 'Myers'),
('Leonardo', 'DiCaprio'),
('Kate', 'Winslet'),
('Sam', 'Worthington');

INSERT INTO obsada (film_id, aktor_id, rola) VALUES
(1, 1, 'Shrek'),
(2, 2, 'Jack'),
(2, 3, 'Rose'),
(3, 4, 'Jake');

INSERT INTO recenzje (film_id, autor, ocena, tresc) VALUES
(1, 'Adam', 9, 'Bardzo fajny film.'),
(2, 'Kasia', 8, 'Ciekawa historia.');