<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $package_name
 * @property string $package_location
 * @property string $package_description
 * @property float $package_price
 * @property float $package_review
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['package_name', 'package_location', 'package_description', 'package_price', 'package_review'], 'required'],
            [['package_description'], 'string'],
            [['package_price', 'package_review'], 'number'],
            [['package_name', 'package_location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package_name' => 'Package Name',
            'package_location' => 'Package Location',
            'package_description' => 'Package Description',
            'package_price' => 'Package Price',
            'package_review' => 'Package Review',
        ];
    }
}
