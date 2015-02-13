<?php

//////////////////////////////////////////////////////////////
// This class generated by a tool on 2015-02-13 at 13:51:58 //
//////////////////////////////////////////////////////////////
class film { 
  private $_id = null;
  private $_nazwa = null;
  private $_cena = null;
  private $_img_url = null;
  private $_opis = null;

  function getid() {
    return $this->_id;
  }
  function getnazwa() {
    return $this->_nazwa;
  }
  function getimg_url() {
    return $this->_img_url;
  }
  function getopis() {
    return $this->_opis;
  }
  function setnazwa($newvalue) {
    if(is_null($newvalue)) {
      throw new Exception("Value cannot be null - nazwa");
    }
    if(gettype($newvalue) != "string") {
      throw new Exception("Value not string - ".$newvalue);
    }
    if(strlen($newvalue) > 200) {
      throw new Exception("Value size larger then then - 200 - ".$newvalue);
    }
    $this->_nazwa = $newvalue;
  }
  function setcena($newvalue) {
    if(is_null($newvalue)) {
      throw new Exception("Value cannot be null - cena");
    }
    // !!!WARNING!!! Unknown type "cena" may not save correctly. You can ignore this if you know how to handle the database type yourself.
    $this->_cena = $newvalue;
  }
  function setimg_url($newvalue) {
    if(is_null($newvalue)) {
      throw new Exception("Value cannot be null - img_url");
    }
    if(gettype($newvalue) != "string") {
      throw new Exception("Value not string - ".$newvalue);
    }
    if(strlen($newvalue) > 500) {
      throw new Exception("Value size larger then then - 500 - ".$newvalue);
    }
    $this->_img_url = $newvalue;
  }
  function setopis($newvalue) {
    if(is_null($newvalue)) {
      throw new Exception("Value cannot be null - opis");
    }
    if(gettype($newvalue) != "string") {
      throw new Exception("Value not string - ".$newvalue);
    }
    $this->_opis = $newvalue;
  }

  function save($db) {
    if(is_null($this->_id)) {
      $query = $db->prepare("INSERT INTO `film` VALUES (NULL,?,?,?,?);");
      $query->execute(array($this->_nazwa,$this->_cena,$this->_img_url,$this->_opis));
      $this->_id = $db->lastInsertId();
    }
    else {
      $query = $db->prepare("UPDATE `film` SET `nazwa`=?,`cena`=?,`img_url`=?,`opis`=? WHERE `id`=? LIMIT 1;");
      $query->execute(array($this->_nazwa,$this->_cena,$this->_img_url,$this->_opis,$this->_id));
    }
  }

  function delete($db) {
    if(is_null($this->_id)) {
      return;
    }
    else {
      $query = $db->prepare("DELETE FROM `film` WHERE `id`=? LIMIT 1;");
      $query->execute(array($this->_id));
    }
  }

  function get($db,$id) {
    if(gettype($id) != "integer") {
      throw new Exception("Value not integer");
    }
    else {
      $query = $db->prepare("SELECT `id`,`nazwa`,`cena`,`img_url`,`opis` FROM `film` WHERE `id`=? LIMIT 1;");
      $query->execute(array($id));
      foreach ($query->fetchAll() as $row_id => $row_data) {
        $this->_id = $row_data["id"];
        $this->_nazwa = $row_data["nazwa"];
        $this->_cena = $row_data["cena"];
        $this->_img_url = $row_data["img_url"];
        $this->_opis = $row_data["opis"];
      }
    }
  }
}
?>