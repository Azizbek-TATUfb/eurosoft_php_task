<?php

namespace shop\repositories;

use shop\entities\User\User;

class UserRepository
{
    public function findByUsernameOrEmail($value)
    {
        return User::find()->andWhere(['or',['username' => $value], ['email' => $value]])->one();
    }
    public function findByNetworkIdentity($network, $identity)
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }
    public function getByEmailConfirmToken($token):User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    public function getByEmail(string $email):User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken($token): User
    {
      return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }
    public function save(User $user){
        if (!$user->save()){
            throw new \RuntimeException('Saving error');
        }
    }

    private function getBy(array $condition):User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()){
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}