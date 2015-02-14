<div class="page-header">
	<h1>
		Internetowy sklep z filmami
	</h1>
<div class="col-md-12 column" style="top:-50px;" id="pagination">
	<ul class="pagination pull-right">
	<li><a href="index.php?p=<?=(($pagination-1)<0)?0:$pagination-1?>">Wstecz</a></li>
	<?php for ($i=0; $i*10 < count($filmy); $i++) { 
		$active = ($pagination==$i)?'class="active"':'';
		echo '<li '.$active.'><a href="index.php?p='.$i.'" >'.$i.'</a></li>';
	} ?>
	<li>
		<a href="index.php?p=<?=$pagination+1?>">Dalej</a>
	</li>
</ul>
</div>
</div>