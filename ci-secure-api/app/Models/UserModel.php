<?php

namespace App\Models;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = [
        'name', 'email', 'password'
    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];

    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdateDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdateDataWithHashedPassword($data);
    }

    private function getUpdateDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = password_hash($plaintextPassword, PASSWORD_BCRYPT);
        }

        return $data;
    }

    public function findUserByEmailAddress(string $emailAddress)
    {
        $user = $this->asArray()->where(['email' => $emailAddress])->first();

        if (!$user) {
            throw new \Exception('Usuario no existe');
        }
        return $user;
    }
}
