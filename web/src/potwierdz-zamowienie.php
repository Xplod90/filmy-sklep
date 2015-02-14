<!-- Tworzenie graficznej formy -->
<h2 style="margin-top:0px;padding-bottom:19px"> <strong>Potwierdź zamówienie</strong></h2>
<form class="form-horizontal col-md-8" role="form" method="post" action="index.php?page=potwierdz-zamowienie">
  <div class="form-group">
    <label  class="col-sm-2 control-label">Imię</label>
    <div class="col-sm-7">
      <input name="imie" type="text" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nazwisko</label>
    <div class="col-sm-7">
      <input name="nazwisko" type="text" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Adres dostawy</label>
    <div class="col-sm-10">
      <textarea name="adres" style="width:100%;min-height:100px"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-succes">Potwierdź</button>
    </div>
  </div>
</form>
<?php
/*
Pobieranie danych post
Działa tylko jeśli do tej strony zostaną przesłane dane z formularza
*/
// jeśli która kolwiek ze zmiennych jest pusta przerwij
if (empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['adres']) || count($_SESSION['filmy-koszyk']) ==0)
  return;

$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$adres = $_POST['adres'];
$zamowioneFilmy = array();
// Pobieramy wszystkie filmy z sesji
foreach ($_SESSION['filmy-koszyk'] as $film) 
  $zamowioneFilmy[] = unserialize($film);



// Tworzymy nowy obiekt zamówienie
$zamowienie = new Zamowienie();
//Ustawiwamy filmy jakie kupił użytkownik
$zamowienie->_filmy = $zamowioneFilmy;
//Ustawiamy dane dostawy
$zamowienie->_dostawa->_imie = $imie;
$zamowienie->_dostawa->_nazwisko = $nazwisko;
$zamowienie->_dostawa->_adres = $adres;

//zapisywanie zamówienia
$zamowienie->save($db);

//Kasujemy stary koszyk
$_SESSION['filmy-koszyk'] = array();
?>
<script>
// Przekierowywujemy do strony z filmami
document.location.href = "index.php?page=zamowieni";
</script>