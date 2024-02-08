<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Packages;

class SiteController extends Controller
{

    /**
     *
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'logout'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'logout'
                        ],
                        'allow' => true,
                        'roles' => [
                            '@'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => [
                        'post'
                    ]
                ]
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Packages::find()->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    
    public function actionSignup()
    {
        $user = new User();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = Yii::$app->request->post();
            
            $user->username = $data['User']['username'];
            $password = $data['User']['password'];
            //$password_repeat = $data['User']['password_repeat'];
            $user->password = Yii::$app->security->generatePasswordHash($password);
            //$user->password_repeat = Yii::$app->security->generatePasswordHash($password_repeat);
            $user->accessType = $data['User']['accessType'];
            $user->accessToken = Yii::$app->security->generateRandomString();
            $user->authKey = Yii::$app->security->generateRandomString();
        
            if ($user->save()) {
                return $this->goHome();
            }
            
            Yii::error("User was not saved. " . VarDumper::dumpAsString($user->errors));
        }
        
        return $this->render('signup', [
            'model' => $user,
        ]);
    }
    
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (! Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findByUsername($model->username);
            if ($user->accessType === User::ACCESS_TYPE_ADMIN) {
                return $this->redirect([
                    '/admin/index'
                ]);
            } elseif ($user->accessType === User::ACCESS_TYPE_CUSTOMER) {
                return $this->redirect([
                    '/customer/index'
                ]);
            } else {
                return $this->render('index');
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model
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
            'model' => $model
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
