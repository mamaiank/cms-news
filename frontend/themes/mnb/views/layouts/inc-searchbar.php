<?php 
	use yii\helpers\Url;
?>
<meta charset="utf-8">

					<div class="mb-from-search">
    					<form action="<?=Url::to(['/news/index'])?>" method="get">
    						<input class="form-control input-lg" name="filterSearch" type="text" placeholder="search" />
    						<span class="glyphicon glyphicon-search mb-search-submit"></span>
    						<input type="hidden" id="search-submit" name="search-submit" value="submit" />
    					</form>
    				</div>
