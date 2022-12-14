<?php
namespace  shop\helpers;
use shop\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelpers
{
    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active'
        ];
    }
    public static function statusName($status) : string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status) : string
    {
        switch ($status){
            case User::STATUS_WAIT:
                $class = 'badge badge-default'; break;
            case User::STATUS_ACTIVE:
                $class = 'badge badge-success'; break;
            default:
                $class = 'badge badge-default'; break;
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status),[
            'class' => $class
        ]);
    }
}