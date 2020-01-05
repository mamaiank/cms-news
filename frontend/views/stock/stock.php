    <?php $page="stock"; ?>

    <?php include(__dir__."/../../themes/mnb/views/layouts/inc-header.php"); ?>

    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="index.php">หน้าแรก</a></li>
                <li class="active">Stock</li>
            </ol>
        </div>
    </div>

    <div id="mb-banner-news" class="show">
        <div class="banner-size">
            <div class="picture">
                <a href=""><img class="img-responsive center-block" src="<?= Yii::$app->request->baseUrl ?>/uploads/banner/Yamaha_Grand-Filano_950x120_GIF.gif" /></a>
            </div>
        </div>
    </div>

    <div class="container"><hr class="line"></div>

    <section class="mb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="heding-all" style="margin-bottom: 5px;">
                        <div class="title SukhumvitSetBold">Stock</div>
                    </div>
                    <div class="number-of-pages"><small>พบข่าวทั้งหมดจำนวน 335 รายการ</small></div>
                    <?php for ($i=0; $i < 10; $i++) { ?>
                    <div class="thumbnail thumbnail-newsall">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pic"><a href="stock-detail.php?id="><img src="<?= Yii::$app->request->baseUrl ?>/uploads/news/NA001.jpg" alt=""></a></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="caption">
                                    <div class="time-post mb-icon icon-clock">23 มกราคม 2560</div>
                                    <h1 class="title-name">
                                        <a href="stock-detail.php?id=">บลจ.กรุงศรี เปิดตัวกองทุน KF-GTECH มองกลุ่มอุตสาหกรรมเทคโนโลยีมีโอกาสโตสูง เตรียม IPO 6-15 ก.พ.นี้</a>
                                    </h1>
                                    <div class="desc">
                                        บลจ.กรุงศรี เสนอขายกองทุนเปิดกรุงศรีโกลบอลเทคโนโลยี
                                        อิควิตี้ (KF-GTECH)  ชูศักยภาพในการสร้างผลตอบแทนจาก
                                        การลงทุนในอุตสาหกรรมเทคโนโลยีที่มีปัจจัยพื้นฐานแข็งแกร่ง  
                                        ทั้งนี้ <a href="stock-detail.php?id=" class="navbar-link">[อ่านต่อ]</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <nav aria-label="Page navigation" class="text-center">
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                </div>
                <div class="col-sm-4">
                    <div id="mb-banner-300x250" class="show">
                        <div class="banner-size">
                            <div class="picture">
                                <a href=""><img class="img-responsive center-block" src="<?= Yii::$app->request->baseUrl ?>/uploads/banner/Banner300x250.jpg" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>