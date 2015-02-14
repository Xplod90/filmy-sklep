
<div class="bs-example" data-example-id="hoverable-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Data</th>
          <th>Filmy</th>
          <th>Imie</th>
          <th>Naziwsko</th>
          <th>Adres dostawy</th>
        </tr>
      </thead>
      <tbody>
<?php
foreach ($zamowienia as $i => $zamowienie) {
	# code...

	echo '<tr >';
	echo '<th scope="row">'.$i.'</th>';
	echo '<th>'.$zamowienie->_czas_zamowienia.'</th>';
	echo '<th ><select style="overflow-y:auto;width:100%" multiple>';
	//var_dump($zamowienie->_filmy);
	foreach ($zamowienie->_filmy as $film) {
		echo '<option>'.$film->_nazwa.'</option>';
	}
	echo '</select></th>';
	echo '<th>'.$zamowienie->_dostawa->_imie.'</th>';
	echo '<th>'.$zamowienie->_dostawa->_nazwisko.'</th>';
	echo '<th>'.$zamowienie->_dostawa->_adres.'</th>';
	echo '</tr>';
} ?>

      </tbody>
    </table>
  </div>
<?php

?>