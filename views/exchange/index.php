<?php


use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $modelPurchase microinginer\CbRFRates\CBRF */
/* @var $modelSale microinginer\CbRFRates\CBRF */
/* @var $numberSale const */
/* @var $numberPurchase const*/
/* @var $selectSale string*/
/* @var $selectPurchase string*/

$this->title = 'Exchange';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="notes-form">
    <?php yii\widgets\Pjax::begin(['id' => 'new_note']) ?>
    <?= Html::beginForm(['exchange/index'], 'post', ['data-pjax' => '', 'class' => 'horizontal']); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputAddress"><?=Yii::t('app', 'Number sale')?></label>
                <?= Html::input('text', 'numberSale', $numberSale, ['class' => 'form-control']) ?>
            </div>
            <div class="form-group">
                <label for="inputAddress"><?=Yii::t('app', 'Number purchase')?></label>
                <?= Html::input('text', 'numberPurchase', $numberPurchase, ['class' => 'form-control']) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputAddress"><?=Yii::t('app', 'Currency sale')?></label>
                <select name="modelSale" class="form-control">
                    <?php if(!empty($modelSale)):?>
                        <?php foreach ($modelSale as $key=>$value):?>
                            <?php if($selectSale == $key){ ?>
                                <option value="<?=$key?>" selected="selected"><?=$value['name']?></option>
                            <?php }else{ ?>
                                <option value="<?=$key?>"><?=$value['name']?></option>
                            <?php } ?>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputAddress"><?=Yii::t('app', 'Currency purchase')?></label>
                <select name="modelPurchase" class="form-control">
                    <?php if(!empty($modelPurchase)):?>
                        <?php foreach ($modelPurchase as $key=>$value):?>
                            <?php if($selectPurchase == $key){ ?>
                                <option value="<?=$key?>" selected="selected"><?=$value['name']?></option>
                            <?php }else{ ?>
                                <option value="<?=$key?>"><?=$value['name']?></option>
                            <?php } ?>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
        </div>
    </div>
    <?= Html::submitButton('Exchange', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
    <?= Html::endForm() ?>
    <?php Pjax::end(); ?>
</div>
