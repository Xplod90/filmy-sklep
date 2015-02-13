<?php
/*
Łaczenie z bazą danych 
*/
 $db = new PDO('mysql:host=localhost;dbname=jumper;charset=utf8', "jumper", "jumper");


/*
Ładowanie potrzebnych klas
*/
require 'src/klasy/film.php';
require 'src/klasy/koszyk.php';
require 'src/klasy/dostawa.php';

/*
Pobieranie wartośc z bazy danych i tworzenie nowych obiektow
Stworzenie odpowiednich tablic
*/
$filmy = array();
$dostawy = array();
$koszyki = array();

/*
Pobieranie filmów i tworzenie ogolnej tablicy zawierającej wszystkie filmy
*/

// Pobieranie ID wszystkich filmów w bazie
foreach($db->query('SELECT `id` from `film`') as $row) {
	//Tworzenie nowego obiektu film
	$film = new Film();
	//Pobieranie wartości do tego filmu
	$film->get($db, $row['id']);
	//Dodawanie nowego filmu do tablicy
	$filmy[] = $film;
}


/*
Pobieranie wszystkich dostaw
Analogicznie do tego jak pobierane są film, dlatego bez komentarzy
*/

foreach($db->query('SELECT `id` from `dostawa`') as $row) {
	$dostawa = new Dostawa();
	$dostawa->get($db, $row['id']);
	$dostawy[] = $dostawa;
}


var_dump($filmy[0]);
?>
