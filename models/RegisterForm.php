<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Line;

/**
 * Signup form
 */
class RegisterForm extends Model
{
    public $type;
    public $username;
    public $namaLengkap;
    public $nip;
    public $role;
    public $lineName;
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
            ['role', 'required', 'when' => function($model) {
                return $model->type == 'akun';
            },
            'whenClient' => "function (attribute, value) {
                return $('#registerform-type').val() == 'akun';
            }",
            'message'=>'{attribute} tidak boleh kosong.'],

            ['namaLengkap', 'required', 'when' => function($model) {
                return $model->type == 'line';
            },
            'whenClient' => "function (attribute, value) {
                return $('#registerform-type').val() == 'line';
            }",
            'message'=>'{attribute} tidak boleh kosong.'],

            ['lineName', 'required', 'when' => function($model) {
                return $model->role == 1;
            },
            'whenClient' => "function (attribute, value) {
                return $('#registerform-role').val() == '1';
            }",
            'message'=>'{attribute} tidak boleh kosong.'],

            [['namaLengkap','nip','tgl_lahir'], 'required', 'when' => function($model) {
                return $model->role == 2;
            },
            'whenClient' => "function (attribute, value) {
                return $('#registerform-role').val() == '2';
            }",
            'message'=>'{attribute} tidak boleh kosong.'],

            [['namaLengkap', 'nip'],'trim'],
            ['namaLengkap' , 'string' , 'min' => 2, 'max' => 255, 'tooShort' => '{attribute} harus mengandung minimal 2 karakter.', 'tooLong' => '{attribute} harus mengandung maximal 10 karakter.'],
            [['nip'],'match', 'pattern' => '/^\d*$/', 'message' => 'NIP harus mengandung angka saja.'],
            [['nip'], 'string', 'min' => 10, 'max' => 10, 'tooShort' => 'NIP harus mengandung 10 karakter.', 'tooLong' => 'NIP harus mengandung 10 karakter.'],

            ['role', 'integer'],
            [['tgl_lahir'], 'date', 'format' => 'php:d/m/Y', 'message'=>'Format {attribute} salah.'],

            [['password'], 'string', 'min' => Yii::$app->params['passwordMinLength'], 'message' => '{attribute} harus mengandung minimal 8 karakter.'],
            [['password'],'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => '{attribute} harus mengandung minimal satu angka, huruf besar dan kecil.'],
        ];
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup($type)
    {
        if($type == 'akun'){
          if ($this->validate()) {
            $this->user = new User();
            $this->user->role = $this->role;
            if($this->role == 1){
              $lines = new Line();
              $line = $lines->findIdentity($this->lineName);
              $this->user->name = $line->name;
              $this->user->images_id = 1;
              $this->password = $this->setPassword("password");
              $this->user->username = $this->setUsername($line->name);
              Line::updateAll(['is_created' => true], ['=','id', $line->id]);
            }else{
              $this->user->name = $this->namaLengkap;
              $this->user->nip = $this->nip;
              $this->user->images_id = 1;
              $this->user->tgl_lahir = $this->tgl_lahir;
              $this->password = $this->setPassword($this->tgl_lahir);
              $this->user->username = $this->setUsername($this->namaLengkap);
            }
            $this->user->setPassword($this->password);
            $this->user->generateAuthKey();
            $this->user->generateVerificationToken();
            $this->user->validateAuthKey($this->user->auth_key);
            $this->user->status = User::STATUS_ACTIVE;
            $this->user->is_online = False;
            setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID');
            $sql = "insert into riwayat (aktivitas,user_id,keterangan,created_at,updated_at) values ('Register Akun',".Yii::$app->user->identity->id.",'Melakukan pendaftaran akun baru bernama ".$this->user->name.".','".strftime("%Y-%m-%d %T")."','".strftime("%Y-%m-%d %T")."');";
            Yii::$app->db->createCommand($sql)->execute();
            return $this->user->save();
          }
        }else{
          $sql = "insert into line (name,is_created) values ('".$this->namaLengkap."',false)";
          Yii::$app->db->createCommand($sql)->execute();
          Yii::$app->session->setFlash('success', '<b>Pendaftaran line baru berhasil dilakukan.</b>');
          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID');
          $sql = "insert into riwayat (aktivitas,user_id,keterangan,created_at,updated_at) values ('Register Line',".Yii::$app->user->identity->id.",'Melakukan pendaftaran line baru bernama ".$this->namaLengkap.".','".strftime("%Y-%m-%d %T")."','".strftime("%Y-%m-%d %T")."');";
          Yii::$app->db->createCommand($sql)->execute();
          Yii::$app->controller->redirect('line');
        }
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
