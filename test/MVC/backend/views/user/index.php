<?php

use kartik\date\DatePicker;
use shop\entities\User\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card users-index">
    <div class="card-header pull-right no-print">
        <?= Html::a('<span class="fa fa-plus"></span>', ['create'],
            ['class' => 'create-dialog btn btn-sm btn-success', 'id' => 'buttonAjax']) ?>
    </div>
    <div class="card-body">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute'=>'created_at',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_from',
                        'attribute2' => 'date_to',
                        'type' => DatePicker::TYPE_RANGE,
                        'separator' => '-',
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ]),
                    'format' => 'datetime'
                ],
                'username',
                'email:email',
                [
                    'attribute'=>'status',
                    'filter' => \shop\helpers\UserHelpers::statusList(),
                    'value' =>function (User $user) {
                        return \shop\helpers\UserHelpers::statusLabel($user->status);
                    },
                    'format' => 'raw'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'contentOptions' => ['class' => 'no-print', 'style' => 'width:150px;'],
                    'visibleButtons' => [
                        'view' => function (User $model) {
                            return Yii::$app->user->can('users/view') || $model->status == $model::STATUS_ACTIVE;
                        },
                        'update' => function (User $model) {
                            return Yii::$app->user->can('users/update') || $model->status == $model::STATUS_ACTIVE;
                        },
                        'delete' => function (User $model) {
                            return Yii::$app->user->can('users/delete') || $model->status == $model::STATUS_ACTIVE;
                        }
                    ],
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
    </div>
</div>