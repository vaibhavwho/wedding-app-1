<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Packages;
use Exception;
use Yii;
use app\models\Enquiry;

class CustomerController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
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
}

