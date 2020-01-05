<?php

namespace common\models;

use Yii;
use common\models\PostViews;

/**
 * This is the model class for table "wp_posts".
 *
 * @property string $ID
 * @property string $post_author
 * @property string $post_date
 * @property string $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_status
 * @property string $comment_status
 * @property string $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $pinged
 * @property string $post_modified
 * @property string $post_modified_gmt
 * @property string $post_content_filtered
 * @property string $post_parent
 * @property string $guid
 * @property integer $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property string $comment_count
 */
class Posts extends \yii\db\ActiveRecord
{
    public $file;
    public $news_type_tag=[];
    public $tag;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wp_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_author', 'post_parent', 'menu_order', 'comment_count'], 'integer'],
            [['post_date', 'post_date_gmt','contributor','contributor_detail','contributor_title', 'post_modified', 'post_modified_gmt','post_pic','news_type_tag','tag'], 'safe'],
            [['post_title'], 'required'],
            [['post_content','contributor_detail', 'post_title','contributor_title', 'post_excerpt', 'to_ping', 'pinged', 'post_content_filtered', 'active','post_pin'], 'string'],
            [['post_status', 'comment_status', 'ping_status', 'post_password', 'post_type'], 'string', 'max' => 20],
            [['post_name'], 'string', 'max' => 200],
            [['guid','post_pic'], 'string', 'max' => 255],
            [['post_mime_type'], 'string', 'max' => 100],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'post_author' => 'สร้างโดย',
            'post_date' => 'สร้างวันที่',
            'post_date_gmt' => 'Post Date Gmt',
            'post_content' => 'เนื้อหา',
            'post_title' => 'หัวข้อ',
            'post_excerpt' => 'Post Excerpt',
            'post_status' => 'Post Status',
            'comment_status' => 'Comment Status',
            'ping_status' => 'Ping Status',
            'post_password' => 'Post Password',
            'post_name' => 'Post Name',
            'to_ping' => 'To Ping',
            'pinged' => 'Pinged',
            'post_modified' => 'แก้ไขวันที่',
            'post_modified_gmt' => 'Post Modified Gmt',
            'post_content_filtered' => 'Post Content Filtered',
            'post_parent' => 'Post Parent',
            'guid' => 'Guid',
            'menu_order' => 'Menu Order',
            'post_type' => 'Post Type',
            'post_mime_type' => 'Post Mime Type',
            'comment_count' => 'Comment Count',
            'file' => 'รูปภาพ',
            'post_pic' => 'รูปภาพ',
            'tag' => 'แท็ก',
            'news_type_tag' => 'หมวดหมู่',
            'contributor_title'=>'หัวข้อคำพูด',
            'contributor_detail'=>'รายละเอียดคำพูด',
            'contributor'=>'เปิด/ปิด กรอบคำพูด',
        ];
    }

    public function getViews()
    {
        return $this->hasMany(PostViews::className(), ['id' => 'ID']);
    }
}
