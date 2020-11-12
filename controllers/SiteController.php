<?php
namespace app\controllers;

use Pusher;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\AddNotif;
use app\models\User;
use app\models\Notifikasi;
use app\models\TaskForm;
use app\models\RegisterForm;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Context;
use app\models\VerifyEmailForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'auth/login';
        return $this->actionLogin();
    }

    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
          $this->layout = 'main';
          $this->view->params['title'] = 'Escalation Apps | Dashboard';
          return $this->render('index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('auth/login', [
            'model' => $model,
        ]);
    }

    public function actionRegister(){
        $this->layout = 'auth/register';
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Terima kasih telah melakukan registrasi. Silahkan cek <b>Email Anda</b> untuk verifikasi akun.');
            return $this->redirect(['site/pegawai']);
        }

        return $this->render('auth/register', [
            'model' => $model,'user'=>Yii::$app->user
        ]);
    }

    public function actionAddtask(){
        $this->layout = 'taskform';
        $this->view->params['title'] = 'Escalation Apps | Ajukan Task';
        $model = new TaskForm();
        if ($model->load(Yii::$app->request->post()) && $model->addTask()) {
            Yii::$app->session->setFlash('success', 'Terima kasih telah membuat task baru.');
            $options = array(
              'cluster' => 'ap1',
              'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
              '61793d530781baf0985a',
              '7d369d9e90d9efdbf4ec',
              '1105147',
              $options
            );
            $data['created_at'] = $model->created_at;
            $data['id'] = $model->id;
            $data['from'] = $model->nameFrom;
            $data['deskripsi'] = $model->deskripsi;
            $data['line'] = $model->lineName;
            $data['role'] = Yii::$app->user->identity->role;
            $data['jenis'] = $model->jenis;
            $pusher->trigger('channel-task', 'new-task', $data);

            $this->layout = 'main';
            return $this->redirect(['index']);
        }

        if((!empty($_POST['forName'])) && (!empty($_POST['task_id']))){
          $forName = $_POST['forName'];
          $task_id = $_POST['task_id'];
          $created_at = $_POST['created_at'];
          $notif = new Notifikasi();
          $checkDuplicate = $notif->findDuplicate($this->findFromId($forName),$task_id,$created_at);
          if($checkDuplicate < 1){
            $notif->setForId($this->findFromId($forName));
            $notif->setTaskId($task_id);
            $notif->setIs_read(False);
            $notif->save();
          }
        }

        return $this->render('addTask', [
            'model' => $model,'user'=>Yii::$app->user
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionProfile(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }

        $model = new RegisterForm();
        $this->view->params['title'] = 'Escalation Apps | Profil';
        return $this->render('profile', ['model'=>$model,'user'=>Yii::$app->user]);
    }

    public function actionPegawai(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Pegawai';
        return $this->render('pegawai', ['user'=>Yii::$app->user]);
    }

    public function actionNotifsetting(){
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }

        $model = new RegisterForm();
        $this->view->params['title'] = 'Escalation Apps | Pengaturan Notifikasi';
        return $this->render('notifSetting', ['model'=>$model,'user'=>Yii::$app->user]);
    }

    public function actionNotifikasi(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Notifikasi';
        return $this->render('notifikasi', ['user'=>Yii::$app->user]);
    }

    public function actionAbout()
    {
        $this->view->params['title'] = 'Escalation Apps | About';
        return $this->render('about');
    }

    public function findFromId($forName){
      $users = new User();
      $user = $users->findByName($forName);
      return $user->id;
    }
}
