<?php

use shop\entities\Shop\Brand;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Brand'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="card">
        <div class="card-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute'=>'name',
                        'format' => 'raw',
                        'value' =>function (Brand $model) {
                            return Html::a(Html::encode($model->name),['view','id'=>$model->id]);
                        },
                    ],
                    'slug',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'contentOptions' => ['class' => 'no-print', 'style' => 'width:150px;'],
//                        'visibleButtons' => [
//                            'view' => function (Brand $model) {
//                                return Yii::$app->user->can('users/view') || $model->status == $model::STATUS_ACTIVE;
//                            },
//                            'update' => function (Brand $model) {
//                                return Yii::$app->user->can('users/update') || $model->status == $model::STATUS_ACTIVE;
//                            },
//                            'delete' => function (Brand $model) {
//                                return Yii::$app->user->can('users/delete') || $model->status == $model::STATUS_ACTIVE;
//                            }
//                        ],
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="fa fa-eye"></span>', $url, [
                                    'title' => Yii::t('app', 'View'),
                                    'class' => 'update-dialog btn btn-xs btn-info mr1',
                                    'data-form-id' => $model->id,
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="fa fa-pencil-alt"></span>', $url, [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'update-dialog btn btn-xs btn-success mr1',
                                    'data-form-id' => $model->id,
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="fa fa-trash-alt"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'class' => 'btn btn-xs btn-danger delete-dialog',
                                    'data-form-id' => $model->id,
                                ]);
                            },

                        ],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>


</div>
