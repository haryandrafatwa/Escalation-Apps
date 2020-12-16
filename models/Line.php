<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property boolean $is_created
 */
class Line extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%line}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findByName($name)
    {
        return static::findOne(['name' => $name]);
    }

    public function getLines(){
        return $this->find()->all();
    }

    public function getLinesRegis(){
        return $this->find(['is_created' => true])->orderBy(['name' => SORT_ASC])->all();
    }
}
