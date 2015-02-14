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

$pagination = 10;
/*
Pobieranie wszystkich zamowien
Analogicznie do tego jak pobierane są filmy, dlatego bez komentarzy

*/
foreach($db->query('SELECT `id` from `zamowienie`') as $row) {
	$zamowienie = new Zamowienie();
	$zamowienie->get($db, $row['id']);
	$zamowienia[] = $zamowienie;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
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
					<a href="#">Filmy</a>
				</li>
				<li>
					<a href="#">Zamowienia</a>
				</li>
				<div class="view pull-right">
				    <ul class="nav nav-pills">
				      <li class="active">
				        <a href="#">
				          <span class="badge pull-right"> X </span>
				          W koszyku
				        </a>
				      </li>
				      <li>
				        <a href="#">
				          <span class="badge pull-right">16$</span>
				          Suma<br/>Zapłać</a>
				      </li>
				    </ul>
					</div>
			</ul>
			<div class="page-header">
				<h1>
					Filmy
				</h1>
			</div>
		</div>
	</div>

	<div class="col-md-12 column" id="content" style="top:30px">
		<?php
		foreach ($filmy as $i=>$film) {
			if ($i>=$pagination)
				break;
		?>
		<div class="row clearfix">
		<div class="col-md-1 column number">
				<?=$i+1?>
		</div>
			<div class="col-md-1 column">
				<img src="<?=$film->_img_url?>">
			</div>
			<div class="col-md-9 column" style="padding-left:40px">
			<h3 style="margin-top:0px"><?=$film->_nazwa?></h3>
				<blockquote contenteditable="true">
				  <p class="opis"><?=$film->_opis?></p>
			    </blockquote>
			</div>
			<div class="col-md-1 column">
				<div class="btn-group btn-group-vertical pull-right">
					 <button class="btn btn-default" type="button"><em class="glyphicon glyphicon-align-left"></em> Left</button> <button class="btn btn-default" type="button"><em class="glyphicon glyphicon-align-center"></em> Center</button> <button class="btn btn-default" type="button"><em class="glyphicon glyphicon-align-right"></em> Right</button> <button class="btn btn-default" type="button"><em class="glyphicon glyphicon-align-justify"></em> Justify</button>
				</div>
			</div>
		</div>
		<hr/>
	<?php
		}
		?>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<ul class="pagination pull-right">
				<li><a href="index.php?p=-1">Prev</a></li>
				<?php for ($i=0; $i*10 < count($filmy); $i++) { 
					echo '<li><a href="index.php?p='.$i.'">'.$i.'</a></li>';
				} ?>
				
				
				<li>
					<a href="index.php?p=+1">Next</a>
				</li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>
