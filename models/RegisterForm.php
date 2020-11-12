<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class RegisterForm extends Model
{
    public $username;
    public $name;
    public $nip;
    public $role;
    public $tgl_lahir;
    public $password;
    public $user;
    public $auth_key;
    public $verification_token;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','username','nip','role','tgl_lahir', 'password'], 'required', 'message'=>'{attribute} tidak boleh kosong.'],
            [['name', 'nip'],'string'],
            [['name', 'nip'],'trim'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['role', 'integer'],
            [['tgl_lahir'], 'date', 'format' => 'php:d/m/Y'],

            [['password'], 'string', 'min' => Yii::$app->params['passwordMinLength'], 'message' => '{attribute} harus mengandung minimal 8 karakter.'],
            [['password'],'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => '{attribute} harus mengandung minimal satu angka, huruf besar dan kecil.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if ($this->validate()) {
            return null;
        }

          $this->user = new User();
          $this->user->name = $this->name;
          $this->user->nip = $this->nip;
          $this->user->role = $this->role;
          $this->user->images_id = 1;
          $this->user->tgl_lahir = $this->tgl_lahir;
          $this->password = $this->setPassword($this->tgl_lahir);
          $this->user->username = $this->setUsername($this->name);
          $this->user->setPassword($this->password);
          $this->user->generateAuthKey();
          $this->user->generateVerificationToken();
          $this->user->validateAuthKey($this->user->auth_key);
          $this->user->status = User::STATUS_ACTIVE;
          $this->user->is_online = False;
          return $this->user->save();
    }

    public function getUser(){
      return $this->user;
    }

    public function setPassword($date){
      $password = str_replace ("/","",$date);
      return $password;
    }

    public function setUsername($name){
        $lower = strtolower($name);
        $user_name = str_replace (" ",".",$lower);
        return $user_name;
    }
}
