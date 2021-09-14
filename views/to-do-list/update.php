<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ToDoList */

$this->title = 'Update To Do List: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'To Do Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="to-do-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
