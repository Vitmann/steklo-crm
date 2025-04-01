<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $created_at
 */
class Client extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'created_at' => 'Дата добавления',
        ];
    }

}
