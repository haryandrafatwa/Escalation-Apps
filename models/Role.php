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
 */
class Role extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%role}}';
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

    public function getRoles($role){
        if($role == '5'){
            return $this->find()->where(['not in','name' ,['Quality Control','Superior MT','Superior QC']])->all();
        }elseif ($role == '4'){
            return $this->find()->where(['name' => 'Quality Control'])->all();
        }
    }
}
