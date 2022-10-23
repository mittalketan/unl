<?php

declare(strict_types=1);

namespace App\Repository;

use App\Contract\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * find Department By Id
     *
     * @param integer $departmentId
     * @return Department
     */
    public function findDepartmentById(int $departmentId): Department
    {
        return Department::findOrFail($departmentId);
    }
}
