<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransferService;
use App\Requests\TransferRequest;

class TransferController extends Controller
{
    protected $transferService;
    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }
    public function transfer(TransferRequest $request)
    {
        $transferData = $request->validated();

        $this->transferService->transfer(
            $transferData['payer_id'],
            $transferData['payee_id'],
            $transferData['amount']
        );

        return response()->json([
            'message' => 'Transferência realizada com sucesso',
        ]);
    }
}
