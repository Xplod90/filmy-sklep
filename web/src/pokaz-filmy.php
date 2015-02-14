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
				<div class="btn-group-vertical" style="height:100%">
					<button class="btn btn-primary" type="button">
					<span class="badge pull-right">Kupiono 323 razy</span> </button>
					
					 <button class="btn btn-success text-align" type="button">
					 Do koszyka <i class="glyphicon glyphicon-plus-sign" style="right:-5px"></i></button> 

					  

		
				</div>
			</div>
		</div>
		<hr/>
	<?php
		}
		?>