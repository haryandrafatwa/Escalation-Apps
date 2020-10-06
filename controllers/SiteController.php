<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

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
    public function behaviors()
    {
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
    public function actions()
    {
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'auth/login';
        return $this->actionLogin();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
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

    public function actionRegister()
    {
        $this->layout = 'auth/register';
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Terima kasih telah melakukan registrasi. Silahkan cek <b>Email Anda</b> untuk verifikasi akun.');
            return $this->actionRegisterDone($model->getUser());
        }

        return $this->render('auth/register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
    $this->view->params['title'] = 'Escalation Apps | About';
        return $this->render('about');
    }

    public function actionRegisterDone($model)
    {
        $new_model = $model;
        $this->layout = 'auth/registerDone';
        return $this->render('auth/registerDone', [
            'model' => $new_model,
        ]);
    }

    public function actionVerifyEmail($token)
    {
        $this->layout = 'auth/verify';
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Akun anda telah terverifikasi!');
                return $this->render('auth/isVerify');
            }
        }
        Yii::$app->session->setFlash('error', 'Maaf, token yang diberikan telah kadaluwarsa.');
        return $this->render('auth/isVerify');
    }
}
