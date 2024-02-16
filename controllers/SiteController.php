<?php
namespace app\controllers;

use Exception;
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


    public function actionIndex()
    {
        
        if(!Yii::$app->user->isGuest){
            
            $id = Yii::$app->user->id;
            $userType = User::find()->where(['id' => $id])->one();
        
            if($userType->accessType == 1){
                return $this->redirect([
                    '/admin/index'
                ]);
            } else if($userType->accessType == 2) {
                return $this->redirect([
                    '/customer/index'
                ]);
                
            }     
        }
            $model = Packages::find()->all();
            return $this->render('index', [
                'model' => $model,
            ]);
    }

    
    public function actionSignup()
    {
        if(Yii::$app->user->isGuest){
            $transaction = Yii::$app->db->beginTransaction();
            $user = new User();
           
            try {
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
                        $transaction->commit();
                        return $this->goHome();
                    }
                    
                    Yii::error("User was not saved. " . VarDumper::dumpAsString($user->errors));
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            
            return $this->render('signup', [
                'model' => $user,
            ]);
        } else {
            
            $id = Yii::$app->user->id;
            $userType = User::find()->where(['id' => $id])->one();
            
            if($userType->accessType == 1){
                return $this->redirect([
                    '/admin/index'
                ]);
            } else if($userType->accessType == 2) {
                return $this->redirect([
                    '/customer/index'
                ]);
                
            } 
        }
    }
    

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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionSearch()
    {
        $searchText = Yii::$app->request->post('searchText');
        $searchedModel = Packages::find()->where(['package_name' => $searchText])->one();
            if($searchedModel){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return['success' => true, 'id' => $searchedModel->id, 'package_name' => $searchedModel->package_name, 'package_description' => $searchedModel->package_description, 'package_lacation' => $searchedModel->package_location, 'package_review' => $searchedModel->package_review, 'package_price' => $searchedModel->package_price,];
            }else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return['success' => false];
            }
        return $this->render('index');
    }
    

    public function actionAbout()
    {
        return $this->render('about');
    }
}
