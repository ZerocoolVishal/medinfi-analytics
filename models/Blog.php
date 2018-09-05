<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $url
 * @property string $launchDate
 * @property int $project
 * @property string $name
 *
 * @property Project $project0
 * @property Blogweekmatric[] $blogweekmatrics
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'launchDate', 'project', 'name'], 'required'],
            [['launchDate'], 'safe'],
            [['project'], 'integer'],
            [['url'], 'string', 'max' => 1000],
            [['name'], 'string', 'max' => 100],
            [['project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'launchDate' => 'Launch Date',
            'project' => 'Project',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject0()
    {
        return $this->hasOne(Project::className(), ['id' => 'project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogweekmatrics()
    {
        return $this->hasMany(Blogweekmatric::className(), ['blog' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogQuery(get_called_class());
    }
}
