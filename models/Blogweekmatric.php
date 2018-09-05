<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blogweekmatric".
 *
 * @property int $id
 * @property int $blog
 * @property int $projectWeek
 * @property int $tw_retweets
 * @property int $tw_impression
 * @property int $tw_comments
 * @property int $fb_likes_share
 * @property int $fb_click
 * @property int $fb_comments
 * @property int $blog_pageview
 * @property int $blog_bannerclicks
 * @property int $blog_online_sale
 *
 * @property Blog $blog0
 * @property Projectweek $projectWeek0
 */
class Blogweekmatric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogweekmatric';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog', 'projectWeek', 'tw_retweets', 'tw_impression', 'tw_comments', 'fb_likes_share', 'fb_click', 'fb_comments', 'blog_pageview', 'blog_bannerclicks', 'blog_online_sale'], 'required'],
            [['blog', 'projectWeek', 'tw_retweets', 'tw_impression', 'tw_comments', 'fb_likes_share', 'fb_click', 'fb_comments', 'blog_pageview', 'blog_bannerclicks', 'blog_online_sale'], 'integer'],
            [['blog'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog' => 'id']],
            [['projectWeek'], 'exist', 'skipOnError' => true, 'targetClass' => Projectweek::className(), 'targetAttribute' => ['projectWeek' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog' => 'Blog',
            'projectWeek' => 'Project Week',
            'tw_retweets' => 'Tw Retweets',
            'tw_impression' => 'Tw Impression',
            'tw_comments' => 'Tw Comments',
            'fb_likes_share' => 'Fb Likes Share',
            'fb_click' => 'Fb Click',
            'fb_comments' => 'Fb Comments',
            'blog_pageview' => 'Blog Pageview',
            'blog_bannerclicks' => 'Blog Bannerclicks',
            'blog_online_sale' => 'Blog Online Sale',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog0()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectWeek0()
    {
        return $this->hasOne(Projectweek::className(), ['id' => 'projectWeek']);
    }

    /**
     * {@inheritdoc}
     * @return BlogweekmatricQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogweekmatricQuery(get_called_class());
    }
}
