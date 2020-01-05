<meta charset="utf-8">

	<div id="mb-header">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-4">
    				<div class="mb-logo">
    					<a href="index.php"><img class="img-responsive" src="img/logoMBOnline.svg" alt="logo"></a>
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
		            <li<?php echo ($page == "index" ? " class=\"active\"" : "") ?>><a href="index.php">Home</a></li>
		            <li class="dropdown<?php echo ($page == "newsupdate" ? " active" : "") ?>">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">News Update <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="news.php?id=">เศรษฐกิจ</a></li>
							<li><a href="news.php?id=">ตลาดเงิน-ตลาดทุน</a></li>
							<li><a href="news.php?id=">ประกัน</a></li>
							<li><a href="news.php?id=">เทคโนโลยี</a></li>
							<li><a href="news.php?id=">ธนาคาร/องค์กรธุรกิจ</a></li>
						</ul>
		            </li>
		            <li<?php echo ($page == "stock" ? " class=\"active\"" : "") ?>>
		            	<a href="stock.php">Stock</a>
		            </li>
		            <li<?php echo ($page == "product" ? " class=\"active\"" : "") ?>>
		            	<a href="product.php">Money & Banking Product</a>
		            </li>
		            <li<?php echo ($page == "tips" ? " class=\"active\"" : "") ?>>
		            	<a href="tips.php">Money Tips</a>
		            </li>
		            <li<?php echo ($page == "investment" ? " class=\"active\"" : "") ?>>
		            	<a href="investment.php">Investment Plan</a>
		            </li>
		            <li class="dropdown<?php echo ($page == "magazine" ? " active" : "") ?>">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">วารสารการเงินธนาคาร <span class="caret"></span></a>
		            	<ul class="dropdown-menu">
		            		<li><a href="magazine.php">Cover Story</a></li>
		            		<li><a href="magazine.php">Exclusive Interview</a></li>
		            		<li><a href="magazine.php">CEO Talk</a></li>
		            		<li><a href="magazine.php">Family Business</a></li>
		            		<li><a href="magazine.php">Young Millionaires</a></li>
		            		<li><a href="magazine.php">บทความพิเศษ</a></li>
		            	</ul>
		            </li>
		            <li<?php echo ($page == "portal" ? " class=\"active\"" : "") ?>>
		            	<a href="portal.php">Money & Banking Portal</a>
		            </li>
		        </ul>
	        </div>
        </div>
    </nav>
