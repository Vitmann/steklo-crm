<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property int $order_id
 * @property float $amount
 * @property string|null $description
 * @property string $expense_date
 * @property string|null $created_at
 *
 * @property Order $order
 */
class Expense extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['order_id', 'amount', 'expense_date'], 'required'],
            [['order_id'], 'integer'],
            [['amount'], 'number'],
            [['expense_date', 'created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'amount' => 'Сумма',
            'description' => 'Описание',
            'expense_date' => 'Дата',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

}
