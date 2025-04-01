<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ContactController extends Controller
{
    public function actionCreate($client_id)
    {
        $model = new Contact();
        $model->client_id = $client_id; // Предзаполняем client_id

        $client = Client::findOne($client_id);
        if (!$client) {
            throw new NotFoundHttpException('Клиент не найден.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Контакт успешно добавлен.');
            return $this->redirect(['client/view', 'id' => $model->client_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'client' => $client,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $client = Client::findOne($model->client_id);
        if (!$client) {
            throw new NotFoundHttpException('Клиент не найден.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Контакт успешно обновлен.');
            return $this->redirect(['client/view', 'id' => $model->client_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'client' => $client,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $client_id = $model->client_id;
        $model->delete();

        Yii::$app->session->setFlash('success', 'Контакт успешно удален.');
        return $this->redirect(['client/view', 'id' => $client_id]);
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Контакт не найден.');
    }
}