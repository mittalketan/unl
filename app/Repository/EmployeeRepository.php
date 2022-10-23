<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Employee;
use App\Models\Department;
use App\Enums\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use App\Contract\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * find Active By Department
     *
     * @param Department $department
     * @return Collection
     */
    public function findActiveByDepartment(Department $department): Collection
    {
        return Employee::where('status', EmployeeStatusEnum::ACTIVE->id())
            ->whereBelongsTo($department)
            ->get();
    }

    /**
     * update Employee Status By Department
     *
     * @param integer $departmentId
     * @param integer $status
     * @return integer
     */
    public function updateEmployeeStatusByDepartment(int $departmentId, int $status): int
    {
        return Employee::where('department_id', $departmentId)
            ->whereNot('status', $status)
            ->update(['status' => $status]);
    }
}
