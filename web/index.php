<?php
/*
Łaczenie z bazą danych 
*/
 $db = new PDO('mysql:host=localhost;dbname=jumper;charset=utf8', "jumper", "jumper");


/*
Ładowanie potrzebnych klas
*/
require 'src/klasy/film.php';
require 'src/klasy/zamowienie.php';
//require 'src/klasy/dostawa.php';

/*
Pobieranie wartośc z bazy danych i tworzenie nowych obiektow
Stworzenie odpowiednich tablic
*/
$filmy = array();
//$dostawy = array();
$zamowienia = array();

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
Pobieranie wszystkich zamowien
Analogicznie do tego jak pobierane są film, dlatego bez komentarzy

*/
foreach($db->query('SELECT `id` from `zamowienie`') as $row) {
	$zamowienie = new Dostawa();
	$zamowienie->get($db, $row['id']);
	$zamowienia[] = $zamowienie;
}


var_dump($zamowienia[0]);
?>
