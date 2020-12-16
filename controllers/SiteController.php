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
use app\models\Task;
use app\models\Line;
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
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
        if(!empty($_GET['type'])){
          $type = $_GET['type'];
        }
        $this->layout = 'auth/register';
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup($type)) {
            Yii::$app->session->setFlash('success', '<b>Pendaftaran akun baru berhasil dilakukan.</b>');
            return $this->redirect(['site/akun']);
        }

        return $this->render('auth/register', [
            'model' => $model,'user'=>Yii::$app->user, 'type'=>$type
        ]);
    }

    public function actionDelline(){
      if(!empty($_GET['id'])){
        $id = $_GET['id'];
      }
      $line = Line::findIdentity($id);
      if(!$line->is_created){
        $sql = "delete from public.line where id =".$id;
        Yii::$app->db->createCommand($sql)->execute();
      }else{
        $sql = "delete from public.user where name = '".$line->name."';";
        Yii::$app->db->createCommand($sql)->execute();
        $sql = "delete from public.line where id =".$id;
        Yii::$app->db->createCommand($sql)->execute();
      }
      return $this->redirect(['site/line']);
    }

    public function actionDeluser(){
      if(!empty($_GET['id'])){
        $id = $_GET['id'];
      }
      if(!empty($_GET['name'])){
        $name = $_GET['name'];
      }
      if(!empty($_GET['role'])){
        $role = $_GET['role'];
      }
      if($role != 1){
        $sql = "delete from public.user where id = ".$id;
      }else{
        Line::updateAll(['is_created' => false], ['=','name', $name]);
        $sql = "delete from public.user where id = ".$id;
      }
      Yii::$app->db->createCommand($sql)->execute();
      return $this->redirect(['site/akun']);
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
          $fromName = $_POST['fromName'];
          $forName = $_POST['forName'];
          $task_id = $_POST['task_id'];
          $line = $_POST['line'];
          $lines = new Line(); $lineNow = $lines->findIdentity($line);
          $created_at = $_POST['created_at'];
          $notif = new Notifikasi();
          $checkDuplicate = Notifikasi::find()->where(['for_id' => $this->findFromId($forName),'task_id' => $task_id,'created_at' => $created_at])->all();
          if(count($checkDuplicate) < 1){
            $notif->setForId($this->findFromId($forName));
            $notif->setTaskId($task_id);
            $notif->setIs_read(False);
            $notif->setDeskripsi($fromName.' mengajukan task baru pada Line '.$lineNow->name.'. Lihat detail task sekarang.');
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

    public function actionAkun(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Akun';
        return $this->render('pegawai', ['user'=>Yii::$app->user]);
    }

    public function actionLine(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Line';
        return $this->render('line', ['user'=>Yii::$app->user]);
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
        return $this->render('notifikasi', ['user'=>Yii::$app->user,'notifikasi'=>Notifikasi::find()->where(['for_id'=> Yii::$app->user->identity->id])->orderBy(['created_at' => SORT_DESC])->all()]);
    }

    public function actionSubmission(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Pengajuan';
        return $this->render('statusTask', ['userNow'=>Yii::$app->user,
        'task'=>Task::find()->where(['status_id' => 1])->orderBy(['created_at' => SORT_DESC])->all(),
        'taskProblem'=>Task::find()->where(['status_id' => 1])->andWhere(['jenis_task' => 'Problem'])->orderBy(['created_at' => SORT_DESC])->all(),
        'taskQuality'=>Task::find()->where(['status_id' => 1])->andWhere(['jenis_task' => 'Quality'])->orderBy(['created_at' => SORT_DESC])->all()]);
    }

    public function actionOngoing(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Sedang Berjalan';
        return $this->render('statusTask', ['userNow'=>Yii::$app->user,
        'task'=>Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->orderBy(['created_at' => SORT_DESC])->all(),
        'taskProblem'=>Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->andWhere(['jenis_task' => 'Problem'])->orderBy(['created_at' => SORT_DESC])->all(),
        'taskQuality'=>Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->andWhere(['jenis_task' => 'Quality'])->orderBy(['created_at' => SORT_DESC])->all()]);
    }

    public function actionTaskdone(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Task Selesai';
        return $this->render('statusTask', ['userNow'=>Yii::$app->user,
        'task'=>Task::find()->where(['status_id' => 4])->orderBy(['created_at' => SORT_DESC])->all(),
        'taskProblem'=>Task::find()->where(['and',['jenis_task' => 'Problem','status_id' => 4]])->orderBy(['created_at' => SORT_DESC])->all(),
        'taskQuality'=>Task::find()->where(['and',['jenis_task' => 'Quality','status_id' => 4]])->orderBy(['created_at' => SORT_DESC])->all()]);
    }

    public function actionTaskundone(){
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }elseif(in_array(Yii::$app->user->identity->role,[1,2,5])){
          $this->view->params['title'] = 'Escalation Apps | Task Tidak Selesai';
          return $this->render('statusTask', ['userNow'=>Yii::$app->user,
          'task'=>Task::find()->where(['status_id' => 5])->orderBy(['created_at' => SORT_DESC])->all(),
          'taskProblem'=>Task::find()->where(['and',['jenis_task' => 'Problem','status_id' => 5]])->orderBy(['created_at' => SORT_DESC])->all(),
          'taskQuality'=>Task::find()->where(['and',['jenis_task' => 'Quality','status_id' => 5]])->orderBy(['created_at' => SORT_DESC])->all()]);
        }
    }

    public function actionDetailtask(){
        $task_id = $_GET['task_id'];
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Detail Task';
        return $this->render('detailTask', ['userNow'=>Yii::$app->user,'task'=>Task::findOne(['id'=> $task_id])]);
    }

    public function actionReaddetailtask(){
        $task_id = $_GET['task_id'];
        Notifikasi::updateAll(['is_read' => true], ['and',['=','for_id', Yii::$app->user->identity->id],['=','task_id', $task_id]]);
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $url = 'index';
            return Yii::$app->response->redirect($url)->send();
        }
        $this->view->params['title'] = 'Escalation Apps | Detail Task';
        return $this->render('detailTask', ['userNow'=>Yii::$app->user,'task'=>Task::findOne(['id'=> $task_id])]);
    }

    public function findFromId($forName){
      $users = new User();
      $user = $users->findByName($forName);
      return $user->id;
    }

    public function actionReadall(){
        Notifikasi::updateAll(['is_read' => true], ['=','for_id', Yii::$app->user->identity->id]);
        $this->layout = 'main';
        return $this->redirect(['site/notifikasi']);
    }

    public function actionReadnotif(){
        $task_id = $_GET['task_id'];
        Notifikasi::updateAll(['is_read' => true], ['and',['=','for_id', Yii::$app->user->identity->id],['=','task_id', $task_id]]);
        $this->layout = 'main';
        return $this->redirect(['site/notifikasi']);
    }

    public function actionAccnow(){
        $task_id = $_GET['task_id'];
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $acc_time = strftime("%Y-%m-%d %T");
        Task::updateAll(['to_id' => Yii::$app->user->identity->id, 'status_id' => 2, 'acc_time' => $acc_time], ['=','id', $task_id]);
        $tasks = new Task();
        $task = $tasks->findIdentity($task_id);

        $notif = new Notifikasi();
        $checkDuplicate = Notifikasi::find()->where(['for_id' => $task->from_id,'task_id' => $task->id,'created_at' => $acc_time])->all();
        if(count($checkDuplicate) < 1){
          $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->from_id.", ".$task->id.",false,'".Yii::$app->user->identity->name." telah menerima task yang telah Anda ajukan. Cek task pada halaman task sedang berlangsung.','".$acc_time."','".$acc_time."')";
          Yii::$app->db->createCommand($sql)->execute();
        }

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
        $data['name'] = Yii::$app->user->identity->name;
        $data['task_id'] = $task->id;
        $pusher->trigger('channel-task', 'acc-task-'.$task->from_id, $data);

        $this->layout = 'main';
        return $this->redirect(['site/detailtask?task_id='.$task_id]);
    }

    public function actionWorknow(){
        $task_id = $_GET['task_id'];
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $work_time = strftime("%Y-%m-%d %T");
        Task::updateAll(['status_id' => 3, 'work_time' => $work_time, 'response_time' => $work_time, 'conf_time_1' => $work_time], ['=','id', $task_id]);
        $tasks = new Task();
        $task = $tasks->findIdentity($task_id);

        $notif = new Notifikasi();
        $checkDuplicate = Notifikasi::find()->where(['for_id' => $task->to_id,'task_id' => $task->id,'created_at' => $work_time])->all();
        if(count($checkDuplicate) < 1){
          $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->to_id.", ".$task->id.",false,'".$task->requester." telah mengkonfirmasi kedatangan Anda. Silahkan perbaiki masalah yang ada.','".$work_time."','".$work_time."')";
          Yii::$app->db->createCommand($sql)->execute();
        }

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
        $data['name'] = Yii::$app->user->identity->name;
        $data['task_id'] = $task->id;
        $pusher->trigger('channel-task', 'conf-task-'.$task->to_id, $data);
        $this->layout = 'main';
        return $this->redirect(['site/detailtask?task_id='.$task_id]);
    }

    public function actionChecknow(){
        $task_id = $_GET['task_id'];
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $work_time = strftime("%Y-%m-%d %T");
        Task::updateAll(['status_id' => 3, 'response_time' => $work_time, 'conf_time_1' => $work_time], ['=','id', $task_id]);
        $tasks = new Task();
        $task = $tasks->findIdentity($task_id);

        $notif = new Notifikasi();
        $checkDuplicate = Notifikasi::find()->where(['for_id' => $task->to_id,'task_id' => $task->id,'created_at' => $work_time])->all();
        if(count($checkDuplicate) < 1){
          $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->to_id.", ".$task->id.",false,'".$task->requester." telah mengkonfirmasi kedatangan Anda. Silahkan perbaiki masalah yang ada.','".$work_time."','".$work_time."')";
          Yii::$app->db->createCommand($sql)->execute();
        }

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
        $data['name'] = Yii::$app->user->identity->name;
        $data['task_id'] = $task->id;
        $pusher->trigger('channel-task', 'conf-task-'.$task->to_id, $data);
        $this->layout = 'main';
        return $this->redirect(['site/detailtask?task_id='.$task_id]);
    }

    public function actionCheckdone(){
        $task_id = $_GET['task_id'];
        if(!empty($_GET['saran'])){
          $saran = $_GET['saran'];
        }
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $done_time = strftime("%Y-%m-%d %T");
        Task::updateAll(['status_id' => 4,'suggestion' => $saran], ['=','id', $task_id]);
        $tasks = new Task();
        $task = $tasks->findIdentity($task_id);

        $notif = new Notifikasi();
        $checkDuplicate = Notifikasi::find()->where(['for_id' => $task->from_id,'task_id' => $task->id,'created_at' => $done_time])->all();
        if(count($checkDuplicate) < 1){
          $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->from_id.", ".$task->id.",false,'".Yii::$app->user->identity->name." telah mengkonfirmasi bahwa hasil kerja Anda telah selesai. Cek detail task pada halaman task selesai.','".$done_time."','".$done_time."')";
          Yii::$app->db->createCommand($sql)->execute();
        }

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
        $data['name'] = Yii::$app->user->identity->name;
        $data['task_id'] = $task->id;
        $pusher->trigger('channel-task', 'done-task-'.$task->to_id, $data);
        $this->layout = 'main';
        return $this->redirect(['site/detailtask?task_id='.$task_id]);
    }

    public function actionFinishnow(){
        $task_id = $_GET['task_id'];
        if(!empty($_GET['suggestion'])){
          $suggestion = $_GET['suggestion'];
        }
        if(!empty($_GET['solution'])){
          $solution = $_GET['solution'];
        }
        $result = $_GET['result'];
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $done_time = strftime("%Y-%m-%d %T");
        if(empty($_GET['suggestion'])){
          Task::updateAll(['status_id' => 4, 'done_time' => $done_time, 'conf_time_2' => $done_time, 'solution' => $solution], ['=','id', $task_id]);
        }else{
          Task::updateAll(['status_id' => 5, 'done_time' => $done_time, 'conf_time_2' => $done_time, 'suggestion' => $suggestion], ['=','id', $task_id]);
        }
        $tasks = new Task();
        $task = $tasks->findIdentity($task_id);

        $notif = new Notifikasi();
        $checkDuplicate = Notifikasi::find()->where(['for_id' => $task->from_id,'task_id' => $task->id,'created_at' => $done_time])->all();
        if(count($checkDuplicate) < 1){
          if(!empty($_GET['suggestion'])){
            $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->from_id.", ".$task->id.",false,'".Yii::$app->user->identity->name." telah mengkonfirmasi bahwa hasil kerja Anda tidak selesai. Cek task pada halaman task tidak selesai.','".$done_time."','".$done_time."')";
            Yii::$app->db->createCommand($sql)->execute();
            if($task->jenis_task == 'Problem'){
              $forID = 1;
            }else{
              $forID = 2;
            }
            $users = new User();
            $user = $users->findIdentity($task->to_id);
            $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->from_id.", ".$task->id.",false,'".Yii::$app->user->identity->name." telah mengkonfirmasi bahwa hasil kerja ".$user->name." tidak selesai. Cek task pada halaman task tidak selesai.','".$done_time."','".$done_time."')";
          }else{
            $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (".$task->from_id.", ".$task->id.",false,'".Yii::$app->user->identity->name." telah mengkonfirmasi bahwa hasil kerja Anda telah selesai. Cek task pada halaman task selesai.','".$done_time."','".$done_time."')";
          }
          Yii::$app->db->createCommand($sql)->execute();
        }

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
        $data['name'] = Yii::$app->user->identity->name;
        $data['task_id'] = $task->id;
        $pusher->trigger('channel-task', 'done-task-'.$task->to_id, $data);

        $this->layout = 'main';
        return $this->redirect(['site/detailtask?task_id='.$task_id]);
    }

    public function actionSendnotifsupv($taskID){
      if(!empty($_GET['taskID'])){
        $taskID = $_GET['taskID'];
      }
      $task = Task::findIdentity($taskID);
      $mtObj = User::findIdentity($task->to_id);
      $line = Line::findIdentity($task->line_id);
      $sql = "insert into notifikasi (for_id, task_id, is_read,deskripsi,created_at,updated_at) values (1, ".$taskID.",false,'".$mtObj->name." sedang memperbaiki task pada line ".$line->name." lebih dari 30 menit. Cek detail task sekarang.','".strftime("%Y-%m-%d %T")."','".strftime("%Y-%m-%d %T")."')";
      Yii::$app->db->createCommand($sql)->execute();

      Task::updateAll(['is_escalated' => true], ['=','id', $task->id]);

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

      $data['deskripsi'] = $mtObj->name." sedang memperbaiki task pada line ".$line->name." lebih dari 30 menit. Cek detail task sekarang.";
      $pusher->trigger('channel-task', 'send-notif-1', $data);
    }

    public function actionUpdateresponsetime(){
        $task_id = $_GET['task_id'];
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $acc_time = strftime("%Y-%m-%d %T");
        Task::updateAll(['response_time' => $acc_time], ['=','id', $task_id]);
    }

    public function actionUpdateworktime(){
        $task_id = $_GET['task_id'];
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        $done_time = strftime("%Y-%m-%d %T");
        Task::updateAll(['done_time' => $done_time], ['=','id', $task_id]);
    }

}
