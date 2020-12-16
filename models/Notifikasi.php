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
 * @property string $deskripsi
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
          'timestamp' => [
              'class' => \yii\behaviors\TimestampBehavior::className(),
              'attributes' => [
                  \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                  \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
              ],
              'value' => new \yii\db\Expression('NOW()'),
          ],
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

    public static function findIs_read($for_id,$is_read)
    {
        return static::findOne(['for_id' => $for_id,'is_read' => $is_read]);
    }

    public static function findDuplicate($for_id,$task_id,$created_at)
    {
        return static::find(['for_id' => $for_id,'task_id' => $task_id,'created_at' => $created_at]);
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

    public function getDeskripsi()
    {
        return $this->deskripsi;
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

    public function setDeskripsi($deskripsi)
    {
        $this->deskripsi = $deskripsi;
    }

    public function beforeSave($insert)
    {
       if (parent::beforeSave($insert)) {
          if($insert)
            setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
             $this->created_at = strftime("%Y-%m-%d %T");
          $this->updated_at = strftime("%Y-%m-%d %T");
          return true;
       } else {
          return false;
       }
    }
}
