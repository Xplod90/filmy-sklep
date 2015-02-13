<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
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
	$zamowienie = new Zamowienie();
	$zamowienie->get($db, $row['id']);
	$zamowienia[] = $zamowienie;
}


//var_dump($zamowienia);

$zamowienie = new Zamowienie();
$zamowienie->_czas_zamowienia = "test";
$zamowienie->_dostawa->_adres = "Krakow, test";
$zamowienie->_filmy[] = $filmy[1];
$zamowienia[] = $zamowienie;
$zamowienie->save($db);
//var_dump($zamowienia);
?>
