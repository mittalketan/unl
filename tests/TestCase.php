<?php

namespace Tests;

use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected Department $department;

    public function createTestEmployees(int $count, Department $department): void
    {
        for ($i = 0; $i <= $count; $i++) {
            $user = new User();

            $user->name = "Test-{$i}";
            $user->password = bcrypt('123456');
            $user->save();

            $employee = new Employee();
            $employee->user()->associate($user);
            $employee->department()->associate($department);
            $employee->status = array_rand([
                EmployeeStatusEnum::ACTIVE->id(),
                EmployeeStatusEnum::BLOCKED->id(),
                EmployeeStatusEnum::INACTIVE->id()
            ]);
            $employee->number = $i + 1;

            $employee->save();
        }
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->department = $this->createTestDepartment('Test department');
    }

    public function createTestDepartment(string $name): Department
    {
        $department = (new Department());

        $department->name = 'Test department';
        $department->save();

        return $department;
    }
}
