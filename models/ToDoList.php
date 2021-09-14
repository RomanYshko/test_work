<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "to_do_list".
 *
 * @property int $id
 * @property string $task
 * @property string $responsible
 * @property int $term
 * @property int $status
 */
class ToDoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'to_do_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task', 'responsible', 'term', 'status'], 'required'],
            [['task'], 'string', 'max' => 255],
            [['responsible'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task' => 'Task',
            'responsible' => 'Responsible',
            'term' => 'Term',
            'status' => 'Status',
        ];
    }
}
