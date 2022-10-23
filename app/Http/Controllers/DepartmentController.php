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
        } catch (ModelNotFoundException $e) { // Resource not found

            return response()->json(['error' => 'Data not found.'], JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $e) { // Anything that went wrong

            return response()->json($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * block employees for a department
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
        } catch (ModelNotFoundException $e) { // Resource not found

            return response()->json(['error' => 'Data not found.'], JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $e) { // Anything that went wrong

            return response()->json($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
