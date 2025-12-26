<?php

namespace App\Services;
use App\Repositories\TransferRepository;
use App\Repositories\UserRepository;

class TransferService
{
    protected $transferRepository;
    protected $userRepository;
    public function __construct(TransferRepository $transferRepository, UserRepository $userRepository)
    {
        $this->transferRepository = $transferRepository;
    }
    public function transfer($payer, $payee, $amount)
    {
        $payerUser = $this->userRepository->findUserById($payer);
        $payeeUser = $this->userRepository->findUserById($payee);

        if (!$payerUser->canTransfer()) {
            throw new \Exception('Payer user cannot transfer');
        }

        if (!$this->checkBalance($payerUser, $amount)) {
            throw new \Exception('Payer user does not have enough balance');
        }

        $payerUser->wallet()->first()->balance -= $amount;
        $payeeUser->wallet()->first()->balance += $amount;

        $this->transferRepository->create([
            'payer_id' => $payerUser->id,
            'payee_id' => $payeeUser->id,
            'status' => 'completed',
            'amount' => $amount,
        ]);

        $payerUser->wallet()->first()->save();
        $payeeUser->wallet()->first()->save();

    }

    public function checkBalance($user, $amount)
    {
        return $user->wallet()->first()->balance >= $amount;
    }
}