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
    public function findActiveByDepartment(Department $department): Collection
    {
        return Employee::where('status', EmployeeStatusEnum::ACTIVE->id())
            ->whereBelongsTo($department)
            ->get();
    }

    public function updateEmployeeStatusByDepartment(int $departmentId, int $status): int
    {
        return Employee::where('department_id', $departmentId)
            ->whereNot('status', $status)
            ->update(['status' => $status]);
    }
}
