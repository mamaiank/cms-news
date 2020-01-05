<?php

namespace common\components; 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\VwPosts;
use common\models\Terms;
use common\models\PostViews;
use backend\models\Slim;
use common\models\VwTag;
 
class MData extends Component
{
    public function getLinkNews($id,$cate,$name)
    {
        $string = $name;
        $string = iconv_substr($name, 0, 50, 'utf-8');
        $string = preg_replace("`\[.*\]`U","-",$string);
        $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
        $string = str_replace('%', '-percent', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace( "`&([a-z])`i","-", $string );
        $string = preg_replace( array("`[^a-z0-9ก-๙เ-า]`i","`[-]+`") , "-", $string);
        $string = strtolower(trim($string, '-'));

        $link = Url::to(['/'.$id.'/'.$cate.'/'.$string]);
        return $link;
    }

	public function showImage($pic='',$option = [],$side='frontend')
	{
        $check = __DIR__.'/../../upload/slim/'.$pic;
        
        if(!file_exists($check) || $pic == null)
        {
            $pic = 'default.jpg';
        }
        if($side=='frontend'){
            return Html::img(Yii::$app->request->baseUrl.'/upload/slim/'.$pic,$option);
        } else {
            return Html::img(Yii::$app->request->baseUrl.'/../upload/slim/'.$pic,$option);
        }
	}

    public function checkHaveFile($file){
        $check = __DIR__.'/../../upload/slim/'.$file;
        
        if(file_exists($check))
        {
            return true;
        } else {
            return false;
        }
    }

    public function showViewPost($id){
        $view = PostViews::find()->where(['id'=>$id,'period'=>'total'])->one();
        if($view) {
            return $view->count;
        } else {
            return 0;
        }
    }

    public function removeImgTag($content,$num_strip){
        $content = preg_replace("/<img[^>]+\>/i", "", $content);
        return strip_tags(iconv_substr($content, 0, $num_strip, 'utf-8')) . '..';
    }
     
        public function getSearchPost($id=null,$key=null){
            $value_search = VwPosts::find()->filterWhere(['in','ID',$id])->orderBy(['post_date'=>SORT_DESC]);
                if(!empty($value_search)){
                    if(!empty($key)){
                        $value[0] = $key;
                        $value[1] = $key;
                    }
                    $newid=array();
                    $data = $value_search->all();
                    foreach($data as $index => $val){
                        $newid[$val->ID] = array('ID'=>$val->ID,'term_taxonomy_id'=>$val->term_taxonomy_id);
                    }
                    $value[2] = VwPosts::find()->orderBy(['post_date'=>SORT_DESC]);
                    foreach($newid as $index => $val){
                        $val_id = $val['ID'];
                        $val_term_taxonomy_id = $val['term_taxonomy_id'];
                        $value[2] =  $value[2]->orWhere("(ID = $val_id and term_taxonomy_id=$val_term_taxonomy_id)");
                    }
//                     echo $value[2]->createCommand()->sql;
//                    exit();
                }else{
                    $value = false;
                }
            return $value;
        }
        
    public function getPost($id=null,$tag=null){
        $model = VwPosts::find()->filterWhere(['in','term_taxonomy_id',$id])->andwhere(['active'=>'active'])->orderBy(['post_date'=>SORT_DESC]);
        $name = Terms::findOne($id);
        if($model->count() == 0){
            $value = false;
            return $value;
        }
        $magazine_id = [10,15,17,16,18,47,56,43];
        $value[0] = ''; //type
        $value[1] = ''; //name type
        $value[2] = ''; //model
        $value[3] = ''; //check news or magazine
        if($id == 12){
            $value[0] = 'product';
            $value[3] = 'news';
        } else if($id == 13){
            $value[0] = 'tips';
            $value[3] = 'news';
        }  else if(in_array($id, $magazine_id)){
            $value[0] = 'magazine';
            $value[3] = 'magazine';
        } else if($id == 61){
            $value[0] = 'stock';
            $value[3] = 'news';
        } else if($id == 62){
            $value[0] = 'investment';
            $value[3] = 'news';
        } else if($id == 63){
            $value[0] = 'portal';
            $value[3] = 'news';
        } else {
            $value[0] = 'newsupdate';
            if($id!=null){
            $value[1] = $name->name;
            }
            $value[2] = $model;
            $value[3] = 'news';

            if(!empty($tag)){
                $data_tag = VwTag::find()->select(['ID','name_tag'])->where(['id_tag'=>$tag])->all();
                $loop_id = array();
                if(!empty($data_tag)){
                    foreach($data_tag as $key => $val){
                        $loop_id[] = $val->ID;
                        $value[0] = $val->name_tag;
                        $value[1] = $val->name_tag;
                    }
                    
                    $value_search = VwPosts::find()->select(['ID','post_title','post_date','post_content','post_pic','term_taxonomy_id'])->distinct()->filterWhere(['in','ID',$loop_id])->orderBy(['post_date'=>SORT_DESC]);
                    $newid=array();
                    $data = $value_search->all();
                    foreach($data as $index => $val){
                        $newid[$val->ID] = array('ID'=>$val->ID,'term_taxonomy_id'=>$val->term_taxonomy_id);
                    }
                    $value[2] = VwPosts::find()->orderBy(['post_date'=>SORT_DESC]);
                    foreach($newid as $index => $val){
                        $val_id = $val['ID'];
                        $val_term_taxonomy_id = $val['term_taxonomy_id'];
                        $value[2] =  $value[2]->orWhere("(ID = $val_id and term_taxonomy_id=$val_term_taxonomy_id)");
                    }
                }else{
                    $value = false;
                }
            }
            return $value;
        }

        $value[1] = $name->name;
        $value[2] = $model;

        return $value;
    }

    public function clickPost($id){
        $Ymd = date('Ymd');
        $Ym = date('Ym');
        $Y = date('Y');
        $viewYmd = PostViews::find()->where(['id'=>$id,'period'=>$Ymd])->one();
        if($viewYmd){
            $viewYmd->count = $viewYmd->count+1;
            $viewYmd->save(false);
        } else {
            $createYmd = new PostViews;
            $createYmd->id = $id;
            $createYmd->type = 0;
            $createYmd->period = $Ymd;
            $createYmd->count =1 ;
            $createYmd->save();
        }
        $viewYm = PostViews::find()->where(['id'=>$id,'period'=>$Ym])->one();
        if($viewYm){
            $viewYm->count = $viewYm->count+1;
            $viewYm->save(false);
        } else {
            $createYm = new PostViews;
            $createYm->id = $id;
            $createYm->type = 2;
            $createYm->period = $Ym;
            $createYm->count =1 ;
            $createYm->save();
        }
        $viewY = PostViews::find()->where(['id'=>$id,'period'=>$Y])->one();
        if($viewY){
            $viewY->count = $viewY->count+1;
            $viewY->save(false);
        } else {
            $createY = new PostViews;
            $createY->id = $id;
            $createY->type = 3;
            $createY->period = $Y;
            $createY->count =1 ;
            $createY->save();
        }
        $viewTotal = PostViews::find()->where(['id'=>$id,'period'=>'total'])->one();
        if($viewTotal){
            $viewTotal->count = $viewTotal->count+1;
            $viewTotal->save(false);
        } else {
            $createTotal = new PostViews;
            $createTotal->id = $id;
            $createTotal->type = 4;
            $createTotal->period = 'total';
            $createTotal->count =1;
            $createTotal->save();
        }
    }

	public function getLink($link=''){
        return urldecode($link); // มี http อยู่
    }

	public function changeFormatDate($date)
    {

        // $model = Usability::model()->findByPk($id);
        $date = explode('-', $date);
        $year = $date[0]+543;
        $month = $date[1];
        $day = $date[2];
        $day = explode(' ', $day);
        $day = $day[0];
        switch ($month) {
            case '01':
                $month = 'มกราคม';
                break;
            case '02':
                $month = 'กุมภาพันธ์';
                break;
            case '03':
                $month = 'มีนาคม';
                break;
            case '04':
                $month = 'เมษายน';
                break;
            case '05':
                $month = 'พฤษภาคม';
                break;
            case '06':
                $month = 'มิถุนายน';
                break;
            case '07':
                $month = 'กรกฎาคม';
                break;
            case '08':
                $month = 'สิงหาคม';
                break;
            case '09':
                $month = 'กันยายน';
                break;
            case '10':
                $month = 'ตุลาคม';
                break;
            case '11':
                $month = 'พฤศจิกายน';
                break;
            case '12':
                $month = 'ธันวาคม';
                break;
            default:
                $month = 'error';
                break;
        }
        return $day.' '.$month.' '.$year;
        // return $day;
    }

    public function getImg($imgs){
        foreach ($imgs as $image) {
            $files = array();

            // save output data if set
            if (isset($image['output']['data'])) {

                // Save the file
                $name = $image['output']['name'];

                // We'll use the output crop data
                $data = $image['output']['data'];

                // If you want to store the file in another directory pass the directory name as the third parameter.
                // $file = Slim::saveFile($data, $name, 'my-directory/');

                // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
                // $file = Slim::saveFile($data, $name, 'tmp/', false);
                $output = Slim::saveFile($data, $name,__DIR__.'/../../upload/slim/');

                array_push($files, $output);
            }

            // save input data if set
            if (isset ($image['input']['data'])) {

                // Save the file
                $name = $image['input']['name'];

                // We'll use the output crop data
                $data = $image['input']['data'];

                // If you want to store the file in another directory pass the directory name as the third parameter.
                // $file = Slim::saveFile($data, $name, 'my-directory/');

                // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
                // $file = Slim::saveFile($data, $name, 'tmp/', false);
                $input = Slim::saveFile($data, $name,__DIR__.'/../../upload/slim/');

                array_push($files, $input);
            }

            $filenames = join(', ', array_map(function($file){ return self::ellipsis($file['name'], 100); }, $files));
            $images = array_map(function($file) {  return '<img src="' . $file['path'] . '" alt=""/>'; }, $files);
            return $filenames;

        }
    }

    function ellipsis($str, $len = 50) {
        return strlen($str) > $len ? substr($str, 0, $len) . '...' : $str;
    }

    public function getFile($filename, $isBasePath=false,$side='frontend')
    {
        if($side=='frontend'){
            $ischeck = Yii::$app->request->baseUrl.'/upload/media/';
            return $ischeck.$filename;
        } else {
            $ischeck = Yii::$app->request->baseUrl.'/../upload/media/';
            return $ischeck.$filename;
        }
    }
}