<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToDoListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'To Do Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="to-do-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create To Do List', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('upload xlsx', ['upload'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'task',
            'responsible',
            'term',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
