
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model */

$this->title = 'Upload To Do List xlsx file';
$this->params['breadcrumbs'][] = ['label' => 'To Do Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>


<?php ActiveForm::end() ?>


