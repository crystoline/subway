<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Meal;
use app\models\OptionType;
use app\models\Order;
use app\models\OrderDetail;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

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
     * @param string $code
     * @return string
     */
    public function actionIndex($code = '')
    {


        $customer = Customer::find()->where(['code' => $code])->one();
        $current_meal = Meal::find()->where(['status' => 1])->one();
        $customer_previous_order = null;
        $customer_order = null;
        if ($customer) {


            if ($current_meal && $customer) {
                $customer_order = $customer->getOrders()->where(['meal_id' => $current_meal->id])->one();
                $customer_previous_order = $customer->getOrders()->orderBy(['id' => SORT_DESC])->one();;
                if ($data = Yii::$app->request->post()) {

                    $option_ids = $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($data['order_detail']));
                    if ($customer_order) {
                        $customer_order->location = @$data['location'];

                    } else {
                        $customer_order = new Order();
                        $customer_order->location = @$data['location'] ?: '';
                        $customer_order->customer_id = $customer->id;
                        $customer_order->meal_id = $current_meal->id;
                    }
                    $customer_order->save();


                    try {
                        foreach ($customer_order->orderDetails as $orderDetail) {
                            $orderDetail->delete();
                        }
                        foreach ($option_ids as $option_id) {
                            $orderDetail = new OrderDetail();
                            $orderDetail->order_id = $customer_order->id;
                            $orderDetail->option_id = $option_id;
                            $orderDetail->save();
                        }
                    } catch (\Exception $exception) {

                    }
                    $customer_order->refresh();

                }


            }


        }


        $option_types = OptionType::find()->orderBy(['sort' => SORT_ASC])->all();
        // $current_meal->load([]);
        return $this->render('index', [
            'customer' => $customer,
            'current_meal' => $current_meal,
            'customer_order' => $customer_order,
            'customer_previous_order' => $customer_previous_order,
            'option_types' => $option_types
        ]);

    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionOrders()
    {
        $current_meal = Meal::find()->where(['status' =>1])->one();
        // $current_meal->load([]);
        return $this->render('orders', [
            'model' => $current_meal
        ]);
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
    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@admin.com';
            $user->setPassword('password');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }

    public function actionRate($order_id, $rating){
        $order = Order::findOne($order_id);
        $order->rating = $rating;
        print  $order->save()? 1: 0;
        return;
    }
}
