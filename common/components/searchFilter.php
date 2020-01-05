<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class searchFilter extends Component
{
	public function activeFilter($searchModel)
	{
		$date_active = ['1'=>'เปิดการใช้งาน','0'=>'ปิดการใช้งาน'];
		return Html::activeDropDownList($searchModel, 'active', $date_active,['class'=>'form-control']);
	}
	public function activeStatus($active){
		if($active == 1){
        	return 'เปิดการใช้งาน';
        } else {
            return 'ปิดการใช้งาน';
        }
	}
}
