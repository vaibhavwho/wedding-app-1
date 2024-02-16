<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Packages;
use app\models\User;
use Exception;
use Yii;
use app\models\Transaction;

class AdminController extends Controller
{
    public function actionIndex() {
        
        if(Yii::$app->user->isGuest){
            return $this->redirect([
                'site/index'
            ]);
        }
        
        $idType = Yii::$app->user->id;
        $isAdmin =  User::find()->where(['id' => $idType])->one();
        if($isAdmin->accessType == 2){
            return $this->redirect([
                'customer/index'
            ]);
        }
        
        $model = Packages::find()->all();
        $transactions = Transaction::find()->all();
        return $this->render('index', [
            'model' => $model,
            'transactions' => $transactions
        ]);
    }

    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect([
                'site/index'
            ]);
        }
        
        $idType = Yii::$app->user->id;
        $isAdmin =  User::find()->where(['id' => $idType])->one();
        if($isAdmin->accessType == 2){
            return $this->redirect([
                'customer/index'
            ]);
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        $model = new Packages();
        
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rawData = file_get_contents("php://input");
                $data = json_decode($rawData, true);
                
                $model->package_name = $data['package_name'];
                $model->package_location = $data['package_location'];
                $model->package_description = $data['package_description'];
                $model->package_price = $data['package_price'];
                $model->package_review = $data['package_review'];

                
                if ($model->save()) {
                    $transaction->commit();
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                } else {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => false, 'error' => 'Failed to save the blog post.'];
                }
                
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
   
    
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect([
                'site/index'
            ]);
        }
        
        $idType = Yii::$app->user->id;
        $isAdmin =  User::find()->where(['id' => $idType])->one();
        if($isAdmin->accessType == 2){
            return $this->redirect([
                'customer/index'
            ]);
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        //$data = new Blog();
        $model = Packages::findOne(['id' => $id]);
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$postData = Yii::$app->request->post();
                $rawData = file_get_contents("php://input");
                $postData = json_decode($rawData, true);
   
                $id = $postData['id'];
                $data = Packages::findOne($id);
                
                $data->package_name = $postData['package_name'];
                $data->package_location = $postData['package_location'];
                $data->package_description = $postData['package_description'];
                $data->package_price = $postData['package_price'];
                $data->package_review = $postData['package_review'];
                
                if ($data->save()) {
                    $transaction->commit();
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                } else {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => false, 'error' => 'Failed to update.'];
                }
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'error' => $e->getMessage()];
        }
        
        //return $this->render('index');
        return $this->render('update', [
            'model' => $model ]);
    }
    
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect([
                'site/index'
            ]);
        }
        
        $idType = Yii::$app->user->id;
        $isAdmin =  User::find()->where(['id' => $idType])->one();
        if($isAdmin->accessType == 2){
            return $this->redirect([
                'customer/index'
            ]);
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        $model = Packages::findOne([
            'id' => $id
        ]);
        //$user = Yii::$app->user->identity;
        try {
            $transaction->commit();
            $model->delete();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        
        
        return $this->redirect('index');
    }
    
    
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect([
                'site/index'
            ]);
        }
        
        $idType = Yii::$app->user->id;
        $isAdmin =  User::find()->where(['id' => $idType])->one();
        if($isAdmin->accessType == 2){
            return $this->redirect([
                'customer/index'
            ]);
        }
        
        $model = Packages::findOne($id);
        return $this->render('view', [
            'model' => $model
        ]);
    }
}

