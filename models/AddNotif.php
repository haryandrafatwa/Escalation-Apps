<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Notifikasi;
use app\models\User;

/**
 * Signup form
 */
class AddNotif extends Model
{
    public $forName;
    public $task_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['for_id','task_id'], 'integer', 'min' => 1, 'message' => '{attribute} harus dipilih.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function addNotif()
    {
      $notif = new Notifikasi();
      $notif->setForId($this->findFromId($this->forName));
      $notif->setTaskId($this->task_id);
      $notif->setIs_read(False);
      return $notif->save();
    }

    public function findFromId($forName){
      $users = new User();
      $user = $users->findByName($forName);
      return $user->id;
    }

    public function setForName($forName){
      $this->forName = $forName;
    }

    public function setTaskId($task_id){
      $this->task_id = $task_id;
    }
}
