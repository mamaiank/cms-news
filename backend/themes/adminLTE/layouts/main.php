<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?php $this->title = 'MnB'; ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <style>
    table {
      width: 100%;
    }
    tbody{
      overflow:scroll;
    }
    td {
      max-width: 0;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>
        <div class="box">
            <div class="box-body">
            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
<script>
function init_tinymce_create() {
    tinymce.init({
        setup:function(ed) {
          // ed.on('change', function(e) {
          //   var text = ed.getContent();
          //   if(text.includes("overflow: hidden")){
          //     var res = text.replace(" overflow: hidden;", "");
          //     tinymce.activeEditor.setContent(res);
          //   }
          // });
          ed.on('focus', function(e) {
            var text = ed.getContent();
            if(text.includes("overflow: hidden")){
              var res = text.replace(" overflow: hidden;", "");
              tinymce.activeEditor.setContent(res);
            }
          });

          ed.on('blur', function(e) {
            var text = ed.getContent();
            if(text.includes("overflow: hidden")){
              var res = text.replace(" overflow: hidden;", "");
              tinymce.activeEditor.setContent(res);
            }
          });
        },
        selector: ".tinymce",theme: "modern",width: '100%',height: 300,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       
       external_filemanager_path:"../../filemanager/",
       filemanager_title:"Filemanager" ,
       external_plugins: { "filemanager" : "../filemanager/plugin.min.js"},
       relative_urls:false,
       remove_script_host:false,
       // document_base_url:"http://localhost/mnb2/"
       // document_base_url:"http://www.moneyandbanking.co.th.203.151.157.196.no-domain.name/"
    });
}

function init_tinymce_update() {
    tinymce.init({
        setup:function(ed) {
          // ed.on('change', function(e) {
          //   var text = ed.getContent();
          //   if(text.includes("overflow: hidden")){
          //     var res = text.replace(" overflow: hidden;", "");
          //     tinymce.activeEditor.setContent(res);
          //   }
          // });
          ed.on('focus', function(e) {
            var text = ed.getContent();
            if(text.includes("overflow: hidden")){
              var res = text.replace(" overflow: hidden;", "");
              tinymce.activeEditor.setContent(res);
            }
          });

          ed.on('blur', function(e) {
            var text = ed.getContent();
            if(text.includes("overflow: hidden")){
              var res = text.replace(" overflow: hidden;", "");
              tinymce.activeEditor.setContent(res);
            }
          });
        },
        selector: ".tinymce",theme: "modern",width: '100%',height: 300,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       
       external_filemanager_path:"../../../filemanager/",
       filemanager_title:"Filemanager" ,
       external_plugins: { "filemanager" : "../filemanager/plugin.min.js"},
       relative_urls:false,
       remove_script_host:false,
       // document_base_url:"http://localhost/mnb2/"
       // document_base_url:"http://www.moneyandbanking.co.th.203.151.157.196.no-domain.name/"
    });
}

$(document).ready(function(){
    $("#posts-tag").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $('.img').hide();
    $('.vdo').hide();
    $('.banner-type').hide();

});

function checkBannerLevel(val){
    if(val != '') {
        $('.img').show();
        $('.hover_status').show();
    }
}

function checkBannerHover(val){
    if(val == 1) {
        $('#banner-hover_status').prop('selectedIndex',1);
    } else {
        $('#banner-hover_status').prop('selectedIndex',0);
    }
}

function checkBannerType(val){
    if(val == 'image') {
        $('.img-hover').show();
    }
    if(val == 'video') {
        $('.vdo').show();
    }
}

</script>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
