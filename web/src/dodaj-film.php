<?
// Hasło po to aby filmów nie mógł dodawać każdy
// HASŁO TO: 123
//
?>
<!-- Tworzenie graficznego formularza -->
<h2 style="margin-top:0px;padding-bottom:19px"> <strong>Dodaj nowy film</strong></h2>
<form class="form-horizontal col-md-8" role="form" method="post" action="index.php?page=dodaj">
  <div class="form-group">
    <label  class="col-sm-2 control-label">Tytuł</label>
    <div class="col-sm-7">
      <input name="nazwa" type="text" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Link do obrazka</label>
    <div class="col-sm-7">
      <input name="img" type="text" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Opis filmu</label>
    <div class="col-sm-10">
      <textarea name="opis" style="width:100%;min-height:100px"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Cena/label>
    <div class="col-sm-7">
      <input name="cena" type="number" stepby="0.01" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Hasło</label>
    <div class="col-sm-7">
      <input name="password" type="passwrod" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-succes">Dodaj film!</button>
    </div>
  </div>
</form>
<?php
/*
Pobieranie danych post
Działa tylko jeśli do tej strony zostaną przesłane dane z formularza
*/



// jeśli która kolwiek ze zmiennych jest pusta przerwij
if (empty($_POST['nazwa']) || empty($_POST['opis']) 
	|| empty($_POST['cena']) || empty($_POST['img'])) 
  return;

// SPRAWDZAMY CZY HASŁO JEST POPRAWNE
if ($_POST['password'] != '123')
{
	// zakończ skrypt

	echo "<script>alert('Błędne hasło');</script>";
	return;
}


// Ustawieanie zmiennych z danych POST
$nazwa = $_POST['nazwa'];
$img = $_POST['img'];
$cena = $_POST['cena'];
$opis = $_POST['opis'];


// Tworzymy nowy obiekt film
$film = new Film();
//Ustawiwamy dane filmu
$film->_nazwa = $nazwa;
$film->_cena = $cena;
$film->_img_url = $img;
$film->_opis = $opis;

//zapisywanie filmu do bazy danych
$film->save($db);

?>
<script>
// Przekierowywujemy do strony z filmami
document.location.href = "index.php?p=<?=floor(count($filmy)/10)?>";
</script>