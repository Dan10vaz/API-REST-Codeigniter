<?php

namespace App\Models;

class ClientModel extends Model
{
    protected $table = 'client';
    protected $allowedFields = [
        'name', 'email', 'retainer_fee'
    ];

    protected $updatedField = 'updated_at';

    public function findClientById($id)
    {
        $client = $this->asArray()->where(['id', $id])->first();

        if (!$client) {
            throw new \Exception('No se puede encontrar un cliente con el Id especificado');
        }

        return $client;
    }
}
