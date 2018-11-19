<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "university".
 *
 * @property int $id
 * @property string $shortname
 * @property string $description
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shortname', 'description'], 'required'],
            [['shortname'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shortname' => 'Shortname',
            'description' => 'Description',
        ];
    }
}
