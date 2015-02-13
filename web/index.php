<?php
/*
Łaczenie z bazą danych 
*/
$link = mysql_connect('localhost', 'jumper', 'jumper', 'jumper');
// Sprzwdź czy poprawnie połączono
if (!$link) {
	// Przerwij działanie skryptu
    die('Nie mozna bylo połączyć z bazą danych: ' . mysql_error());
}


/*
Ładowanie potrzebnych klas
*/
require 'src/klasy/film.php';
require 'src/klasy/koszy.php';
require 'src/klasy/dostawa.php';


?>
