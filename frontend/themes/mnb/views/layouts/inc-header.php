<?php 
	use yii\helpers\Url;
?>

	<div id="mb-header">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-4">
    				<div class="mb-logo">
    					<a href="<?= Url::to(['/site/index']) ?>"><img class="img-responsive" src="<?= Yii::$app->request->baseUrl ?>/frontend/web/img/logoMBOnline.svg" alt="logo"></a>
    				</div>
    			</div>
    			<div class="col-sm-4 hidden-xs">
    				<?php include("inc-searchbar.php"); ?>
    			</div>
    			<div class="col-sm-4 hidden-xs">
    				<div class="mb-icon-social text-right">
    					<?php include("inc-link-social.php"); ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <nav id="mb-navbar" class="navbar navbar-default navbar-static-top">
    	<div class="container">
    		<div class="navbar-header">
    			<div class="visible-xs">
    				<?php include("inc-searchbar.php"); ?>
    			</div>
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	              <span class="sr-only">Toggle navigation</span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	            </button>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
		        <ul class="nav navbar-nav SukhumvitSetBold">
		            <li<?php echo ($page == "index" ? " class=\"active\"" : "") ?>><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
		            <li class="dropdown<?php echo ($page == "newsupdate" ? " active" : "") ?>">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">News Update <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= Url::to(['/news/index','id'=> 8]) ?>">เศรษฐกิจ</a></li>
							<li><a href="<?= Url::to(['/news/index','id'=> 22]) ?>">ตลาดเงิน-ตลาดทุน</a></li>
							<li><a href="<?= Url::to(['/news/index','id'=> 5]) ?>">ประกัน</a></li>
							<li><a href="<?= Url::to(['/news/index','id'=> 27]) ?>">เทคโนโลยี</a></li>
							<li><a href="<?= Url::to(['/news/index','id'=> 25]) ?>">ธนาคาร/องค์กรธุรกิจ</a></li>
						</ul>
		            </li>
		            <li<?php echo ($page == "stock" ? " class=\"active\"" : "") ?>>
		            	<a href="<?= Url::to(['/news/index','id'=> 61]) ?>">Stock</a>
		            </li>
		            <li<?php echo ($page == "product" ? " class=\"active\"" : "") ?>>
		            	<a href="<?= Url::to(['/news/index','id'=> 12]) ?>">Money Product</a>
		            </li>
		            <li<?php echo ($page == "tips" ? " class=\"active\"" : "") ?>>
		            	<a href="<?= Url::to(['/news/index','id'=> 13]) ?>">Money Tips</a>
		            </li>
		            <li<?php echo ($page == "investment" ? " class=\"active\"" : "") ?>>
		            	<a href="<?= Url::to(['/news/index','id'=> 62]) ?>">Investment Plan</a>
		            </li>
		            <li class="dropdown<?php echo ($page == "magazine" ? " active" : "") ?>">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">วารสารการเงินธนาคาร <span class="caret"></span></a>
		            	<ul class="dropdown-menu">
		            		<li><a href="<?= Url::to(['/magazine/index','id'=> 15]) ?>">Cover Story</a></li>
		            		<li><a href="<?= Url::to(['/magazine/index','id'=> 17]) ?>">Exclusive Interview</a></li>
		            		<li><a href="<?= Url::to(['/magazine/index','id'=> 16]) ?>">CEO Talk</a></li>
		            		<li><a href="<?= Url::to(['/magazine/index','id'=> 18]) ?>">Family Business</a></li>
		            		<li><a href="<?= Url::to(['/magazine/index','id'=> 47]) ?>">Young Millionaires</a></li>
		            		<li><a href="<?= Url::to(['/magazine/index','id'=> 56]) ?>">บทความพิเศษ</a></li>
		            	</ul>
		            </li>
		            <li<?php echo ($page == "portal" ? " class=\"active\"" : "") ?>>
		            	<a href="<?= Url::to(['/news/index','id'=> 60]) ?>">Money & Banking Portal</a>
		            </li>
		        </ul>
	        </div>
        </div>
    </nav>
