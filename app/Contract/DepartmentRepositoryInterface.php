<?php

declare(strict_types=1);

namespace App\Contract;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentRepositoryInterface
{
    public function findDepartmentById(int $departmentId): Department;
}
