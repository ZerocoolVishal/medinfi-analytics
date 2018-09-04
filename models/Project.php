<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property int $company
 * @property int $tw_retweets_target
 * @property int $tw_impression_target
 * @property int $tw_comments_target
 * @property int $fb_likes_share_target
 * @property int $fb_click_target
 * @property int $fb_comments_target
 * @property int $blog_pageview_target
 * @property int $blog_bannerclicks_target
 * @property int $blog_online_sale_target
 * @property int $duration
 * @property int $accountManager
 * @property string $launchDate
 *
 * @property Blog[] $blogs
 * @property Users $accountManager0
 * @property Projectweek[] $projectweeks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company', 'tw_retweets_target', 'tw_impression_target', 'tw_comments_target', 'fb_likes_share_target', 'fb_click_target', 'fb_comments_target', 'blog_pageview_target', 'blog_bannerclicks_target', 'blog_online_sale_target', 'duration', 'accountManager', 'launchDate'], 'required'],
            [['company', 'tw_retweets_target', 'tw_impression_target', 'tw_comments_target', 'fb_likes_share_target', 'fb_click_target', 'fb_comments_target', 'blog_pageview_target', 'blog_bannerclicks_target', 'blog_online_sale_target', 'duration', 'accountManager'], 'integer'],
            [['launchDate'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['accountManager'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['accountManager' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'company' => 'Company',
            'tw_retweets_target' => 'Tw Retweets Target',
            'tw_impression_target' => 'Tw Impression Target',
            'tw_comments_target' => 'Tw Comments Target',
            'fb_likes_share_target' => 'Fb Likes Share Target',
            'fb_click_target' => 'Fb Click Target',
            'fb_comments_target' => 'Fb Comments Target',
            'blog_pageview_target' => 'Blog Pageview Target',
            'blog_bannerclicks_target' => 'Blog Bannerclicks Target',
            'blog_online_sale_target' => 'Blog Online Sale Target',
            'duration' => 'Duration',
            'accountManager' => 'Account Manager',
            'launchDate' => 'Launch Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['project' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountManager0()
    {
        return $this->hasOne(Users::className(), ['id' => 'accountManager']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectweeks()
    {
        return $this->hasMany(Projectweek::className(), ['project' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
}
