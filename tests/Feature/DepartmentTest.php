<?php

namespace Tests\Feature;

use App\Enums\EmployeeStatusEnum;
use App\Http\Controllers\DepartmentController;
use App\Models\Employee;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * TODO: 6. Six issue.
     * You have to run a test and make sure that the functionality you wrote works
     *
     * @see DepartmentController::getActiveEmployees()
     *
     */
    public function test_get_active_employees(): void
    {
        $this->createTestEmployees(40, $this->department);

        $activeEmployeesCount = Employee::query()
            ->where('status', EmployeeStatusEnum::ACTIVE->id())
            ->count();

        $response = $this->get("/api/departments/{$this->department->getKey()}/active-employees");

        $response->assertStatus(200)
            ->assertJsonCount($activeEmployeesCount);
    }

    /**
     * TODO: 7. Seven issue.
     * You have to run a test and make sure that the functionality you wrote works
     *
     * @see DepartmentController::blockEmployees()
     *
     */
    public function test_block_employees(): void
    {
        $this->createTestEmployees(40, $this->department);
        $response = $this->post("/api/departments/{$this->department->getKey()}/block-employees");

        $response->assertStatus(200);
    }
}
