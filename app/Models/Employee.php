<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmployeeStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read int $id
 * @property-read int $department_id
 * @property-read int $user_id
 * @property int $status
 * @property int $number
 */
class Employee extends Model
{
    use  HasFactory;

    protected $table = 'employees';

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatus(): EmployeeStatusEnum
    {
        return EmployeeStatusEnum::fromId($this->status);
    }
}
