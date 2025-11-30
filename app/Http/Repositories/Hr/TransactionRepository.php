<?php

namespace App\Http\Repositories\Hr;

use App\Http\DTOs\Hr\Transaction\Request\TransactionRequestDto;
use App\Interfaces\Hr\Transaction\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function __construct(protected Transaction $transaction)
    {
    }

    public function store(TransactionRequestDto $request): Transaction
    {
        $data = TransactionRequestDto::toLower($request->toArray());
        return $this->transaction->create($data);
    }
}
