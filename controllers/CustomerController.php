<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Packages;
use Exception;
use Yii;
use app\models\Enquiry;
use app\models\Transaction;
use app\models\User;

class CustomerController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->id;
        
        try {
            $purchasedPackages = Transaction::find()
            ->select(['product_id'])
            ->where(['customer_id' => $user])
            ->column();
            $allPackages = Packages::find()->all();
            
            return $this->render('index', [
                'model' => $allPackages, 
                'purchasedPackages' => $purchasedPackages,
            ]);
        } catch (\Exception $e) {
            Yii::error('Error: ' . $e->getMessage());
            return "error";
        }
    }
    
    
    public function actionEnquiry($id) {
        $model = Packages::findOne(['id' => $id]);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = new Enquiry();
            try {
                $rawData = file_get_contents("php://input");
                $postData = json_decode($rawData, true);
                //print_r($postData);
                //die();
                $data->packageId = $postData['packageId'];
                $data->enqName = $postData['enqName'];
                $data->enqEmail = $postData['enqEmail'];
                $data->enqContact = $postData['enqContact'];
                $data->enqAddress = $postData['enqAddress'];
                $data->enqMessage = $postData['enqMessage'];
                
                if($data->save()){
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                } else {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => false, 'error' => 'Failed to save the enquiry.'];
                }      
                
            } catch (Exception $e) {
                //$transaction->rollBack();
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
        return $this->render('enquiry', [
            'model' => $model,
        ]);
    }
    
    public function actionBuypackage($id) {
        $model = Packages::findOne(['id' => $id]);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = new Transaction();
            try {
                $rawData = file_get_contents("php://input");
                $postData = json_decode($rawData, true);
                //print_r($postData);
                //die();
                $data->customer_id = $postData['userId'];
                $data->product_id = $postData['productId'];
                $data->amount = $postData['amount'];
                $data->purchase_date = date('Y-m-d H:i:s');
                if($data->save()){
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                } else {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => false, 'error' => 'Failed to save the enquiry.'];
                }
                
            } catch (Exception $e) {
                //$transaction->rollBack();
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
        return $this->render('buypackage', [
            'model' => $model,
        ]);
    }
}

