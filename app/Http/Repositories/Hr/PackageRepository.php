<?php

namespace App\Http\Repositories\Hr;

use App\Interfaces\Hr\Package\PackageRepositoryInterface;
use App\Models\Package;

class PackageRepository implements PackageRepositoryInterface
{
    public function __construct(protected Package $package)
    {
    }

    public function packageById(int $id): ?Package
    {
        return $this->package
            ->with(['templateTypes:id,name'])
            ->find($id);
    }
}
