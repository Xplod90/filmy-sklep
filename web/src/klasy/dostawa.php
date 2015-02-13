<?php
/*
Klasa dostawy
*/
class Dostawa { 
  //id dostawy
  public $_id = null;
  // Adres dostawy
  public $_adres = null;
  // Dane osoby kupującej
  public $_imie = null;
  public $_naziwsko = null;
  /*
  Funkcja zapisująca do bazy danych
  */
  function save($db) {
    // Wysyłanie zapytania dodającego
    $query = $db->prepare("INSERT INTO `dostawa` VALUES (null,?,?,?);");
    $query->execute(array($this->_adres, $this->_imie, $this->_naziwsko));
    // Pobieranie id 
    $this->_id = $db->lastInsertId();
  }
  // usuwanie rekordu z bazy danych
  function delete($db) {
    $query = $db->prepare("DELETE FROM `dostawa` WHERE `id`=? LIMIT 1;");
    $query->execute(array($this->_id));
  }
  // Pobieranie konkretnej dostawy po id
  function get($db, $id) {
    //Wysyła zapytanie SQL do bazy danych i pobiera dany rekord
    $query = $db->prepare("SELECT `id`,`adres`, `imie`, `naziwsko` FROM `dostawa` WHERE `id`=? LIMIT 1;");
    $query->execute(array($id));
    //Pobiera konretne pola z rekordu i przypisuje je do zmiennych
    foreach ($query->fetchAll() as $row_id => $row_data) {
      $this->_id = $row_data["id"];
      $this->_adres = $row_data["adres"];
      $this->_imie = $row_data["imie"];
      $this->_naziwsko = $row_data["naziwsko"];
    }
  }
}

?>