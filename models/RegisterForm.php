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
    public $name;
    public $email;
    public $password;
    public $repassword;
    public $user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email', 'password'], 'required', 'message'=>'{attribute} tidak boleh kosong.'],
            ['name', 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Alamat email ini sudah pernah digunakan.'],

            [['password', 'repassword'], 'string', 'min' => Yii::$app->params['passwordMinLength'], 'message' => '{attribute} harus mengandung minimal 8 karakter.'],
            [['password','repassword'],'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => '{attribute} harus mengandung minimal satu angka, huruf besar dan kecil.'],

            ['repassword', 'required', 'message'=>'Ulang Kata Sandi tidak boleh kosong.']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $this->user = new User();
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        if ($this->password == $this->repassword) {
          $this->user->setPassword($this->password);
          $this->user->generateAuthKey();
          $this->user->generateEmailVerificationToken();
          $this->user->isVerify = false;
          return $this->user->save() && $this->sendEmail($this->user);
        }else{
          Yii::$app->session->setFlash('error', 'Password harus sama.');
        }

    }

    public function getUser(){
      return $this->user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name . ' Bot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
