<?php

namespace App\Services;

use App\DataTransferObjects\StaffDto;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

class StaffService
{
    public static function getStaffs(): Collection
    {
        $staffs = Staff::all();

        return $staffs;
    }

    public function createMethod(StaffDto $staffDto): Staff
    {
        return Staff::create([
            'name' => $staffDto->name,
            'email' => $staffDto->email,
            'department' => $staffDto->department,
        ]);

    }

    public function updateDepartment(int $id, StaffDto $staffDto): Staff
    {
        $staff = Staff::find($id);

        return tap($staff)->update([
            'department' => $staffDto->department,
        ]);
    }
}
