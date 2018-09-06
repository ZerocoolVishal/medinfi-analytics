<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $mobile
 * @property string $password
 * @property string $userType
 * @property int $lastUpdateBy
 * @property string $lastUpdateTime
 *
 * @property Client[] $clients
 * @property Project[] $projects
 * @property Users $lastUpdateBy0
 * @property Users[] $users
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'mobile', 'password', 'userType', 'lastUpdateBy'], 'required'],
            [['userType'], 'string'],
            [['lastUpdateBy'], 'integer'],
            [['lastUpdateTime'], 'safe'],
            [['email', 'name', 'password'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['lastUpdateBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['lastUpdateBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'userType' => 'User Type',
            'lastUpdateBy' => 'Last Update By',
            'lastUpdateTime' => 'Last Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['accountManager' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastUpdateBy0()
    {
        return $this->hasOne(Users::className(), ['id' => 'lastUpdateBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['lastUpdateBy' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
