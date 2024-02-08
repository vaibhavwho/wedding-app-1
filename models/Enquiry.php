<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property int $id
 * @property int $packageId
 * @property string $enqName
 * @property string $enqEmail
 * @property string $enqContact
 * @property string $enqAddress
 * @property string $enqMessage
 */
class Enquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['packageId', 'enqName', 'enqEmail', 'enqContact', 'enqAddress', 'enqMessage'], 'required'],
            [['packageId'], 'integer'],
            [['enqAddress', 'enqMessage'], 'string'],
            [['enqName', 'enqEmail'], 'string', 'max' => 255],
            [['enqContact'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'packageId' => 'Package ID',
            'enqName' => 'Enq Name',
            'enqEmail' => 'Enq Email',
            'enqContact' => 'Enq Contact',
            'enqAddress' => 'Enq Address',
            'enqMessage' => 'Enq Message',
        ];
    }
}
