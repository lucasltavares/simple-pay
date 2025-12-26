<?php

namespace App\Repositories;

class TransferRepository
{
    public function create($data)
    {
        return Transfer::create($data);
    }
}
