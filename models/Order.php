<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $client_id
 * @property float $amount
 * @property string $start_date
 * @property string|null $created_at
 *
 * @property Expense[] $expenses
 * @property Payment[] $payments
 */
class Order extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'amount', 'start_date'], 'required'],
            [['client_id'], 'integer'],
            [['amount'], 'number'],
            [['start_date', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Клиент',
            'amount' => 'Сумма заказа',
            'start_date' => 'Начало работ по заказу',
            'created_at' => 'Дата создания заказа',
        ];
    }

    public function getPayments()
    {
        return $this->hasMany(Payment::class, ['order_id' => 'id']);
    }

    public function getExpenses()
    {
        return $this->hasMany(Expense::class, ['order_id' => 'id']);
    }

    public function getTotalPayments()
    {
        return $this->getPayments()->sum('amount') ?? 0;
    }

    public function getTotalExpenses()
    {
        return $this->getExpenses()->sum('amount') ?? 0;
    }

    public function getProfit()
    {
        return $this->getTotalPayments() - $this->getTotalExpenses();
    }

    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

}
