<?php
// Przeleć całą pętle filmy i wyświetl każdy film
	foreach ($filmy as $i=>$film) {
		// Jesli index ($i) jest wiekszy niż ostatni rekord który ma zostać wyświetlany ($end)
		// lub
		// Jeśli index ($i) jest mniejszy niż pierwszy rekord od ktorego zaczynamy wyswietlanie
		// Nie wyświetlaj filmu ( to jest odnośnie numerowania stron )
			if ($i>=$end || $i<$start)
				continue;
		?>
		<div class="row clearfix">
		<div class="col-md-1 column number">
		<!-- Numer filmu -->
				<?=$i+1?>
		</div>
			<div class="col-md-1 column">
				<!-- Adres do obrazka -->
				<img src="<?=$film->_img_url?>">
			</div>
			<div class="col-md-9 column" style="padding-left:40px">
			<h3 style="margin-top:0px"><?=$film->_nazwa?></h3>
				<blockquote >
				  <p class="opis"><?=$film->_opis?></p>
			    </blockquote>
			</div>
			<div class="col-md-1 column">
				<div class="btn-group-vertical" style="height:100%">
					<!---<button class="btn btn-primary" type="button">
					<span class="badge pull-right">Kupiono 323 razy</span> </button>-->
					<?php 
					// jeśli film jest juz w koszyku to bez możliwości jego ponownego kupienia
	
					$id = array_search(serialize($film), $_SESSION['filmy-koszyk']);
					if (!$id and $id !== 0){
						?>

					 <a class="btn btn-success text-align" type="button" href="index.php?p=<?=$pagination?>&add=<?=$film->_id?>">
					 Do koszyka <i class="glyphicon glyphicon-plus-sign" style="right:-5px"></i></a> 
					 <?php } else {
					 	// Wyświetl przycisk do usuwania z koszyka
					 	?>
					 	<a class="btn btn-danger text-align" type="button" href="index.php?p=<?=$pagination?>&rem=<?=$id?>">
					 Usuń z koszyka <i class="glyphicon glyphicon-minus-sign" style="right:-5px"></i></a> 

					 	<?php
					 }

					  ?>

		
				</div>
			</div>
		</div>
		<hr/>
	<?php
		}
		?>