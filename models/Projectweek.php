<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projectweek".
 *
 * @property int $id
 * @property int $project
 * @property string $name
 * @property string $startDate
 * @property string $endDate
 *
 * @property Blogweekmatric[] $blogweekmatrics
 * @property Project $project0
 */
class Projectweek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectweek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project', 'name', 'startDate', 'endDate'], 'required'],
            [['project'], 'integer'],
            [['startDate', 'endDate'], 'safe'],
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
            'project' => 'Project',
            'name' => 'Name',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogweekmatrics()
    {
        return $this->hasMany(Blogweekmatric::className(), ['projectWeek' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject0()
    {
        return $this->hasOne(Project::className(), ['id' => 'project']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectweekQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectweekQuery(get_called_class());
    }
}
