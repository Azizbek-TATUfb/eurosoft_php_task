<?php

namespace shop\forms\manage\User;

use shop\entities\User\User;

class UserCreateForm extends \yii\base\Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'] , 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
        ];
    }

}