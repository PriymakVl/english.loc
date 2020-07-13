<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\BreadcrumbsHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $cat->name;

$this->params['breadcrumbs'] = BreadcrumbsHelper::category($cat, false);

?>
<div class="text-index">

    <h1>Перечень текстов</h1>
    <p><b>категория:</b> <?= $cat->name ?></p>

    <p>
        <?= Html::a('Добавить текст', ['create', 'cat_id' => $cat->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            ['attribute' => 'title', 'format' => 'raw', 'value' => function($model) {
                    if ($model->engl) return Html::a($model->title, ['view', 'id' => $model->id]);
                    return $model->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
