<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use App\Models\Department;
use App\Enums\EmployeeStatusEnum;
use Illuminate\Http\JsonResponse;
use App\Contract\EmployeeRepositoryInterface;
use App\Contract\DepartmentRepositoryInterface;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentController extends Controller
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
        private EmployeeRepositoryInterface $employeeRepository
    ) {
    }

    /**
     * get Active Employees
     *
     * @param integer $departmentId
     * @return JsonResponse
     */
    public function getActiveEmployees(int $departmentId): JsonResponse
    {
        try {

            $department = $this->departmentRepository->findDepartmentById($departmentId);
            $employees = $this->employeeRepository->findActiveByDepartment($department);
            return response()->json($employees);
        } catch (ModelNotFoundException $e) {

            return response()->json(["error" => "Resource not found"], 404);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * block Employees
     *
     * @param integer $departmentId
     * @return JsonResponse
     */
    public function blockEmployees(int $departmentId): JsonResponse
    {

        try {

            $department = $this->departmentRepository->findDepartmentById($departmentId);
            $noOfRecordUpdated = $this->employeeRepository->updateEmployeeStatusByDepartment($department->id, EmployeeStatusEnum::BLOCKED->id());
            return response()->json(['data' => $noOfRecordUpdated . ' records are updated']);
        } catch (ModelNotFoundException $e) {

            return response()->json(["error" => "Resource not found"], 404);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 500);
        }
    }
}
