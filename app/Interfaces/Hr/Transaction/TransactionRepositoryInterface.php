<?php

namespace App\Interfaces\Hr\Transaction;

use App\Http\DTOs\Hr\Transaction\Request\TransactionRequestDto;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function store(TransactionRequestDto $request): Transaction;
}
