<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Task model
 *
 * @property integer $id
 * @property integer $for_id
 * @property integer $task_id
 * @property boolean $is_read
 * @property string $created_at
 * @property string $updated_at
 */
class Notifikasi extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notifikasi}}';
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
          [['for_id','task_id'], 'integer', 'min' => 1, 'message' => '{attribute} harus dipilih.'],
      ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findByFor($for_id)
    {
        return static::findOne(['for_id' => $for_id]);
    }

    public static function findDuplicate($for_id,$task_id,$created_at)
    {
        return static::findOne(['for_id' => $for_id,'task_id' => $task_id,'created_at' => $created_at]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getFor_id()
    {
        return $this->for_id;
    }

    public function getTask_id()
    {
        return $this->task_id;
    }

    public function getIs_read()
    {
        return $this->is_read;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setForId($for_id)
    {
        $this->for_id = $for_id;
    }

    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
    }

    public function setIs_read($is_read)
    {
        $this->is_read = $is_read;
    }
}
