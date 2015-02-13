<?php

/*
 importowanie potrzebnyc klas
*/
require 'dostawa.php';
require 'film.php';

/*
Tworzenei klasy zamówienia
*/
class Zamowienie { 
  // ID zamówienia
  public $_id = null;
  // Czas zamówienia, jest wartością domyslną dodawaną przy dodawaniu rekordu do bazy danych
  public $_czas_zamowienia = null;
  // Jest to zmienna zawierająca obiekt dostawę (adres dostarczenia filu)
  public $_dostawa;
  // zamowienie zawiera filmy
  // Jest to tablica przechowująca obiekty filmów
  public $_filmy = array();

  // Konstruktor aby ustawić typ dostawy
  public function __construct()
   {
    // Ustawienie dostawy jako nowy obiekt
    $this->_dostawa = new Dostawa();
   }

   /*
   Zapis do bazy danych
   Na parametrze przyjmuje łącze do bazy danych $bd
   */
  function save($db) {
     // Zapisanie obiektu dostawy do bazy danych
    $this->_dostawa->save($db);
    // Zapyatanie SQL które wstawia rekord zamówienie do bazy
    $query = $db->prepare("INSERT INTO `zamowienie` (`dostawa_id`) VALUES (?);");
    $query->execute(array($this->_dostawa->_id));
    // pobierz id nowego dodanego rekordu
    $this->_id = $db->lastInsertId();

    //Dodawanie do tabeli lączącej
    // Zamówienie może posiadać wiele filmów
    // Każdy taki film trzeba zapisać do tabeli lączącej (id_zamowienia, id_filmu)
    foreach ($this->_filmy as $film) {
      // Wykonaj zapytanie SQL dodające do bazy
      $query = $db->prepare("INSERT INTO `zamowienie_film` (`zamowienie_id`, `film_id`) VALUES (?,?);");
      $query->execute(array($this->_id,$film->_id));
    }
  }
  /*
    Usuwanie zamówienia z bazy
  */
  function delete($db) {
    //Wykonaj zapytanie SQL
    $query = $db->prepare("DELETE FROM `zamowienie` WHERE `id`=? LIMIT 1;");
    $query->execute(array($this->_id));
    
  }
  /*
    Pobieranie konkretnego zamówienia z bazy
    na parametrach ID zamówienia i link do bazy danych
  */
  function get($db,$id) {
    // Pobierz zamówienie o ID
    $query = $db->prepare("SELECT `id`,`czas_zamowienia`,`dostawa_id` FROM `zamowienie` WHERE `id`=? LIMIT 1;");
    $query->execute(array($id));
    // uzupełnia wszystkie dane o zamówieniu pobranym z bazy danych
    foreach ($query->fetchAll() as $row_id => $row_data) {
      $this->_id = $row_data["id"];
      $this->_czas_zamowienia = $row_data["czas_zamowienia"];
      //Pobiera informacje o dostawie
      $this->_dostawa->get($db,  $row_data["dostawa_id"]);
      // Pobiera informacje z tabeli łączącej jakie filmy posiada te zamówienie
      $query = $db->prepare("SELECT `film_id` FROM `zamowienie_film` WHERE `zamowienie_id`=?;");
      $query->execute(array($this->_id));
      foreach ($query->fetchAll() as $row_id => $row_data) {
        // Dodaj obiekt film do zamówienia
        $film = new Film();
        $film->get($db, $row_data["film_id"]);
        $this->filmy[] = $film;
      }

    }
    
  }
}
?>