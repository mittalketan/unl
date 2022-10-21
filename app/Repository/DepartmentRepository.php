<?php

declare(strict_types=1);

namespace App\Repository;

use App\Contract\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function findDepartmentById(int $departmentId): Department
    {

        return Department::findOrFail($departmentId);
    }
}
