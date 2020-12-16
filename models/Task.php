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
 * @property string $requester
 * @property string $jenis_task
 * @property integer $line_id
 * @property string $deskripsi
 * @property integer $status_id
 * @property integer $response_time
 * @property integer $acc_time
 * @property integer $work_time
 * @property integer $done_time
 * @property integer $conf_time_1
 * @property integer $conf_time_2
 * @property string $suggestion
 * @property string $solution
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
          [['requester','jenis_task','deskripsi'], 'string', 'min' => 4, 'message' => '{attribute} harus mengandung minimal 4 karakter.'],
          ['line_id', 'integer', 'min' => 1, 'message' => '{attribute} harus dipilih.'],
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
        return static::find()->where(['from_id' => $from_id])->orWhere(['to_id' => $from_id])->all();
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

    public function getRequester()
    {
        return $this->requester;
    }

    public function getJenis_task()
    {
        return $this->jenis_task;
    }

    public function getResponse_time()
    {
        return $this->response_time;
    }

    public function getWork_time()
    {
        return $this->work_time;
    }

    public function getComf_time_1()
    {
        return $this->conf_time_1;
    }

    public function getComf_time_2()
    {
        return $this->conf_time_2;
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

    public function getSuggestion()
    {
        return $this->suggestion;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    public function setFromId($from_id)
    {
        $this->from_id = $from_id;
    }

    public function setToId($to_id)
    {
        $this->to_id = $to_id;
    }

    public function setRequester($requester)
    {
        $this->requester = $requester;
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

    public function setResponse_time($response_time)
    {
        $this->response_time = $response_time;
    }

    public function setWork_time($work_time)
    {
        $this->work_time = $work_time;
    }

    public function setConf_time_1($conf_time_1)
    {
        $this->conf_time_1 = $conf_time_1;
    }

    public function setConf_time_2($conf_time_2)
    {
        $this->conf_time_2 = $conf_time_2;
    }

    public function setSuggestion($suggestion)
    {
        $this->suggestion = $suggestion;
    }

    public function setSolution($solution)
    {
        $this->solution = $solution;
    }

    public function beforeSave($insert)
    {
       if (parent::beforeSave($insert)) {
          if($insert)
            setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID');
             $this->created_at = strftime("%Y-%m-%d %T");
          $this->updated_at = strftime("%Y-%m-%d %T");
          return true;
       } else {
          return false;
       }
    }
}
