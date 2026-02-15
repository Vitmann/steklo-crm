<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller as BaseController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Company;
use app\models\User;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Registration action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $company = new Company();
                $company->name = $model->company_name;
                $company->created_at = $company->updated_at = time();
                if (!$company->save()) {
                    $model->addError('company_name', 'Не удалось создать компанию.');
                    if (isset($transaction) && $transaction) {
                        $transaction->rollBack();
                    }
                    return $this->render('register', ['model' => $model]);
                }
                $user = new User();
                $user->username = $model->username;
                $user->email = $model->email;
                $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $user->auth_key = Yii::$app->security->generateRandomString();
                $user->created_at = $user->updated_at = time();
                $user->company_id = $company->id;
                $user->is_confirmed = false;
                $user->generateEmailConfirmToken();
                if (!$user->save()) {
                    $model->addErrors($user->getErrors());
                    if (isset($transaction) && $transaction) {
                        $transaction->rollBack();
                    }
                    return $this->render('register', ['model' => $model]);
                }
                // Отправка письма с подтверждением
                $confirmUrl = Url::to(['/site/confirm-email', 'token' => $user->email_confirm_token], true);
                Yii::$app->mailer->compose('email-confirm', [
                        'confirmUrl' => $confirmUrl,
                        'user' => $user
                    ])
                    ->setFrom(['noreply@example.com' => 'CRM'])
                    ->setTo($user->email)
                    ->setSubject('Подтверждение регистрации')
                    ->send();
                if (isset($transaction) && $transaction) {
                    $transaction->commit();
                }
                return $this->redirect(['site/email-sent']);
            } catch (\Exception $e) {
                if (isset($transaction) && $transaction) {
                    $transaction->rollBack();
                }
                $model->addError('company_name', 'Ошибка регистрации: ' . $e->getMessage());
            }
        }
        return $this->render('register', ['model' => $model]);
    }

    /**
     * Displays email confirmation waiting page.
     *
     * @return string
     */
    public function actionEmailSent()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('email-sent');
    }

    public function actionConfirmEmail($token)
    {
        $user = User::findByEmailConfirmToken($token);
        if (!$user) {
            Yii::$app->session->setFlash('error', 'Некорректный или устаревший токен подтверждения.');
            return $this->redirect(['site/login']);
        }

        // Сохраняем ID пользователя до подтверждения
        $userId = $user->id;

        // Подтверждаем email
        $user->confirmEmail();

        // Теперь ищем пользователя заново (так как is_confirmed изменился)
        $user = User::findOne($userId);

        if (!$user || !$user->is_confirmed) {
            Yii::$app->session->setFlash('error', 'Ошибка подтверждения email.');
            return $this->redirect(['site/login']);
        }

        // Пробуем авторизоваться
        $loginResult = Yii::$app->user->login($user, 3600*24*30);

        if ($loginResult) {
            Yii::$app->session->setFlash('success', 'Email успешно подтверждён! Вы автоматически вошли в систему.');
        } else {
            Yii::$app->session->setFlash('error', 'Email подтверждён, но автоматический вход не выполнен. Пожалуйста, войдите вручную.');
        }

        return $this->goHome();
    }
}
