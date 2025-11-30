<?php

namespace App\Interfaces\Hr\Package;

use App\Models\Package;

interface PackageRepositoryInterface
{
    public function packageById(int $id): ?Package;
}
