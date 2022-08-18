<?php

namespace shop\services\auth;

use frontend\forms\SignupForm;
use shop\entities\User\User;
use yii\mail\MailerInterface;

class SingupService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function signup(SignupForm $form): User
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );
        $this->save($user);

        $send = $this->mailer
            ->compose(
                ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();

        if (!$send){
            throw new \RuntimeException('Email sending error.');
        }
    }

    public function confirm($token){
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->save($user);
    }

    private function getByEmailConfirmToken(string $token): User
    {
        if (!$user = User::findOne(['email_confirm_token' => $token])) {
            throw new \DomainException('User is not found.');
        }
        return $user;
    }

    private function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

}