<?php

/*
Klasa film
*/
class film { 
  // Poszczegolne zmienne do kazdego filmu
  public $_id = null;
  public $_nazwa = null;
  public $_cena = null;
  public $_img_url = null;
  public $_opis = null;

  // Zapisanie obiektu do bazy $db - łącze do bazy danych tworzone w index.php
  function save($db) {
    // Jeżeli to jest nowo dodany film
    if(is_null($this->_id)) {
      // Wyslij zapytanie SQL do zapisania filmu do bazy
      $query = $db->prepare("INSERT INTO `film` VALUES (NULL,?,?,?,?);");
      $query->execute(array($this->_nazwa,$this->_cena,$this->_img_url,$this->_opis));
      // Pobierz id ostatnio dodanego rekordu i ustaw go jako id obecnego obiektu 
      $this->_id = $db->lastInsertId();
    }
    else {
      // Jeśli to jest zakutalizacjia
      // Wysyła zapytanie aktuzalizujące rekord w bazie danych
      $query = $db->prepare("UPDATE `film` SET `nazwa`=?,`cena`=?,`img_url`=?,`opis`=? WHERE `id`=? LIMIT 1;");
      $query->execute(array($this->_nazwa,$this->_cena,$this->_img_url,$this->_opis,$this->_id));
    }
  }

  /*
  Usuwanie filmu z bazy
  */
  function delete($db) {
    // Wyślij zapytanie SQL kasujące rekord w bazie danych w tabeli filmy
      $query = $db->prepare("DELETE FROM `film` WHERE `id`=? LIMIT 1;");
      $query->execute(array($this->_id));
  }

/*
  Pobiranie konkretnego filmu z bazy po $id 
*/
  function get($db,$id) {
    // Wyślij zapytanie pobierające konkretny rekord z tabeli filmy
    $query = $db->prepare("SELECT `id`,`nazwa`,`cena`,`img_url`,`opis` FROM `film` WHERE `id`=? LIMIT 1;");
    //Wykonaj
    $query->execute(array($id));
    // Ustawia wszystkie zmienne klasy
    // row_data jest to pole z rekordu pobranego z bazy danych
    foreach ($query->fetchAll() as $row_id => $row_data) {
      $this->_id = $row_data["id"];
      $this->_nazwa = $row_data["nazwa"];
      $this->_cena = $row_data["cena"];
      $this->_img_url = $row_data["img_url"];
      $this->_opis = $row_data["opis"];
    }
  }
}

?>