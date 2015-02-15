<?php
// Łączna cena wszystkich filmów w koszyku, ustawiamy zmienną na 0
$summaryPrice = 0;
//Ilość filmów w koszyku (rozmiar tablicy)
$ilosc = count($_SESSION['filmy-koszyk']);
?>
<div class="view pull-right">
   <div class="btn-group">
        <span class="btn btn-info" data-html="true" data-toggle="tooltip" data-placement="bottom" data-original-title="
        <?php
        
        foreach ($_SESSION['filmy-koszyk'] as $film) {

        	// Wyświetla wszystkie filmy jakie są w koszyku ich nazwę i cenę
        	// Na internetice znaleźliźmy funkcje serialize() i unserialize() ktore pozwalając przetrzymywać 
        	// klasy w danych sesji
        	$film = unserialize($film);
        	echo $film->_nazwa.' - '.$film->_cena.'$<br/>';
        	$summaryPrice += $film->_cena;
        }
        ?>">
          <!-- Wyświetlenie ilość filmów w koszyku -->
          <span class="badge"> <?=$ilosc?> </span>
          <small>filmow w koszyku</small>
        </span>
    
        <!-- Link do potwierdzania płatności, aktywyny tylko gdy ilość w koszyku jest większa niż 0 -->
        <a  href="index.php?page=potwierdz-zamowienie" class="btn btn-success <?=($ilosc>0)?'':' disabled"'?>">
        <i class="glyphicon glyphicon-shopping-cart pull-right"></i>
          <span class="badge pull-right">
          <?=$summaryPrice?>$ </span>
          Zapłać </a>
          <!-- Przycisk do usuwania wszystkich filmów z koszyka -->
          <a href="index.php?rem=-1" class="btn btn-danger">
          <i class="glyphicon glyphicon-minus pull-right" style="right:-7px"></i>
          Kasuj koszyk</a>
      
   </div>
</div>

<script>
// Inicjowanie tooltipów 
$(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>