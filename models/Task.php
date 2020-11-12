<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Task model
 *
 * @property integer $id
 * @property integer $from_id
 * @property integer $to_id
 * @property string $jenis_task
 * @property integer $line_id
 * @property string $deskripsi
 * @property integer $status_id
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task}}';
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
            ['deskripsi', 'string', 'min' => 4, 'message' => '{attribute} harus mengandung minimal 4 karakter.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByFrom($from_id)
    {
        return static::findOne(['from_id' => $from_id]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getFromId()
    {
        return $this->from_id;
    }

    public function getToId()
    {
        return $this->to_id;
    }

    public function getJenis_task()
    {
        return $this->jenis_task;
    }
    /**
     * {@inheritdoc}
     */
    public function getLine_id()
    {
        return $this->line_id;
    }

    public function getDeskripsi()
    {
        return $this->deskripsi;
    }
    public function getStatus_id()
    {
        return $this->status_id;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setFromId($from_id)
    {
        $this->from_id = $from_id;
    }

    public function setToId($to_id)
    {
        $this->to_id = $to_id;
    }

    public function setJenis_task($jenis_task)
    {
        $this->jenis_task = $jenis_task;
    }

    /**
     * {@inheritdoc}
     */
    public function setLine_id($line_id)
    {
        $this->line_id = $line_id;
    }

    public function setDeskripsi($deskripsi)
    {
        $this->deskripsi = $deskripsi;
    }
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;
    }
}
