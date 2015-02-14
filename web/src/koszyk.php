<?php
$summaryPrice = 0;
?>
<div class="view pull-right">
   <div class="btn-group">
        <span class="btn btn-info" data-html="true" data-toggle="tooltip" data-placement="bottom" data-original-title="
        <?php
        
        foreach ($_SESSION['filmy-koszyk'] as $film) {
        	$film = unserialize($film);
        	echo $film->_nazwa.' - '.$film->_cena.'$<br/>';
        	$summaryPrice += $film->_cena;
        }
        ?>">
          <span class="badge"> <?=count($_SESSION['filmy-koszyk'])?> </span>
          <small>filmow w koszyku</small>
        </span>
    
      
        <a href="#" class="btn btn-success">
        <i class="glyphicon glyphicon-shopping-cart pull-right"></i>
          <span class="badge pull-right">
          <?=$summaryPrice?>$ </span>
          Zapłać </a>
          <a href="index.php?rem=-1" class="btn btn-danger"><i class="glyphicon glyphicon-minus pull-right"></i>Usuń wszystko</a>
      
   </div>
</div>

<script>
$(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>