<?php

namespace shop\services\auth;

use frontend\forms\PasswordResetRequestForm;
use common\repositories\UserRepository;
use frontend\forms\ResetPasswordForm;
use yii\mail\MailerInterface;
use Yii;

class PasswordResetService
{
    private $mailer;
    private $users;
    public function __construct(MailerInterface $mailer, UserRepository $users){
        $this->mailer = $mailer;
        $this->users = $users;
    }

    /**
     * @param PasswordResetRequestForm $form
     * @return void
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form)
    {
        $user = $this->users->getByEmail($form->email);

        if (!$user->isActive()){
            throw new \DomainException('User is not active.');
        }

        $user->requestPasswordReset();
        $this->users->save($user);

        $send = $this->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
        if (!$send) {
            throw new \RuntimeException('Sending error.');
        }
    }

    /**
     * @param $token
     * @return void
     */
    public function validateToken($token){
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reser token.');
        }
    }

    /**
     * @param string $token
     * @param ResetPasswordForm $form
     * @return void
     */
    public function reset(string $token, ResetPasswordForm $form){
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }
}