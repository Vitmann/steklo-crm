<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as BaseController;
use yii\filters\AccessControl;

class Controller extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site'], // Разрешаем контроллер SiteController
                        'actions' => ['index'],    // Только действие index
                        'roles' => ['?'],          // Только для гостей (?)
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],          // Разрешаем всё авторизованным
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
        ];
    }
}