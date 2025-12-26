<?php

namespace App\Requests;

use Illuminate\Http\Request;

class TransferRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payer_id' => 'required|exists:users,id',
            'payee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
        ];
    }
}
