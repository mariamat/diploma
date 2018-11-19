<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $title
 * @property string $time_start
 * @property string $time_end
 * @property string $date_start
 * @property int $duration_minutes
 * @property int $recurring
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time_start', 'time_end', 'date_start', 'duration_minutes'], 'required'],
            [['time_start', 'time_end', 'date_start'], 'safe'],
            [['duration_minutes', 'recurring'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'date_start' => 'Date Start',
            'duration_minutes' => 'Duration Minutes',
            'recurring' => 'Recurring',
        ];
    }
}
