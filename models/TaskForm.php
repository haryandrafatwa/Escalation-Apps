<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Task;
use app\models\User;
use app\models\Line;

/**
 * Signup form
 */
class TaskForm extends Model
{
    public $id;
    public $nameFrom;
    public $jenis;
    public $lineName;
    public $deskripsi;
    public $created_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nameFrom','jenis','deskripsi'], 'string', 'min' => 4, 'message' => '{attribute} harus mengandung minimal 4 karakter.'],
            ['lineName', 'integer', 'min' => 1, 'message' => '{attribute} harus dipilih.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function addTask()
    {
        if ($this->validate()) {
          $task = new Task();
          $task->setFromId($this->findFromId($this->nameFrom));
          $task->setJenis_task($this->jenis);
          $task->setLine_id($this->lineName);
          $task->setDeskripsi($this->deskripsi);
          $task->setStatus_id(1);
          $task->save();
          $this->created_at = $task->created_at;
          $this->id = $task->id;
          return $this->id ;
        }
    }

    public function getId(){
      return $this->id;
    }

    public function getTask(){
      return $this->task;
    }
    public function findFromId($nameFrom){
      $users = new User();
      $user = $users->findByName($nameFrom);
      return $user->id;
    }

    public function findLineName($lineName){
      $users = new Line();
      $user = $users->findIdentity($lineName);
      return $user->name;
    }
}
