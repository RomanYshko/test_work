<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\behaviors\TimestampBehavior;
use yii\filters\VerbFilter;
use elzix\CurrencyConverter\CurrencyConverter;



class ExchangeController extends \yii\web\Controller
{

    const Number = 1;
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete', 'upload'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'upload'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                TimestampBehavior::class,
            ]
        );
    }

    public function actionIndex()
    {
        header('Content-Type: text/html; charset=UTF-8',true);

        $modelSale = Yii::$app->CbRF->all();
        $modelPurchase = Yii::$app->CbRF->all();
        $numberSale = self::Number;
        $numberPurchase = self::Number;

        $selectSale = NULL;
        $selectPurchase = NULL;

        if(!empty(Yii::$app->request->post())){
            $selectSale = Yii::$app->request->post('modelSale');
            $selectPurchase = Yii::$app->request->post('modelPurchase');
            $numberSale = Yii::$app->request->post('numberSale');
            $converter = new CurrencyConverter();
            $result =  $converter->convert('16e4199ae42d4521aa911268621c9693', $selectSale, $selectPurchase);
            $numberPurchase = $result * $numberSale;
        }

        return $this->render('index',[
            'modelPurchase' => $modelPurchase,
            'modelSale' => $modelSale,
            'numberSale' => $numberSale,
            'numberPurchase' => $numberPurchase,
            'selectSale' => $selectSale,
            'selectPurchase' => $selectPurchase
        ]);
    }


    

}
