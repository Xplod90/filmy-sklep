<?php
// start sesji - potrzebny do koszyka
session_start();
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


	//jeżeli film został dodany do koszyka 
	if ($_GET['add'] == $row['id'])
	{
		// Dodaj do danych sesji bieżący film
		$_SESSION['filmy-koszyk'][] = serialize($film);

	}

} 

//$_SESSION['filmy-koszyk'][] = serialize($filmy[2]);
/*
Pobieranie wszystkich zamowien
Analogicznie do tego jak pobierane są filmy, dlatego bez komentarzy

*/
foreach($db->query('SELECT `id` from `zamowienie`') as $row) {
	$zamowienie = new Zamowienie();
	$zamowienie->get($db, $row['id']);
	$zamowienia[] = $zamowienie;
}

/*
Numerowanie stron
*/
// jeśli zmienna $_GET jest pusta to domyślnie zacznij pokazywać pierwszą stronę
if (empty($_GET['p']))
	$pagination = 0; else
	$pagination = $_GET['p'];

//Pokazuj rekordy od
$start = $pagination*10;
//Pokazuj rekordy do
$end = $pagination*10+10;

/*
Koszyk - usuwanie danych 
*/
$rid= $_GET['rem'];
// jeśli nie jest pusta to usuń z tablicy\
if (!is_null($rid))
{

	// jesli równe -1 to usuń caly koszyk
	if ($rid == -1)
		$_SESSION['filmy-koszyk'] = array();
	
	unset($_SESSION['filmy-koszyk'][$rid]);
	//array_search(serialize($film), $_SESSION['filmy-koszyk']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sklep internetowy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column" style="top:30px">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="index.php">Filmy</a>
				</li>
				<li>
					<a href="index.php?page=zamowienia">Zamowienia</a>
				</li>
				
				<?php include('src/koszyk.php')?>
			</ul>
			
			<?php
			// Załączamy strone z tytułem i listowaniem 
			include('src/header.php');
			?>
		</div>
	</div>

	<div class="col-md-12 column" id="content" style="top:30px">
		<?php 
		if ($_GET["page"] == "filmy" || !$_GET["page"])
			include("src/pokaz-filmy.php"); 
		elseif ($_GET["page"] == "zamowienia"){
			include("src/pokaz-zamowienia.php");
			}
		?>
	</div>
</div>

</body>
</html>
