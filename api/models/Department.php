<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $shortname
 * @property string $description
 * @property int $university_id
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shortname', 'description', 'university_id'], 'required'],
            [['university_id'], 'integer'],
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
            'university_id' => 'University ID',
        ];
    }
}
