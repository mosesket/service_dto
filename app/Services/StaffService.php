<?php

namespace App\Services;

use App\Models\Staff;

class StaffService
{
    public static function getStaffs()
    {
        $staffs = Staff::all();

        return $staffs;
    }

    public function createMethod(string $name, string $email, string $department)
    {
        return Staff::create([
            'name' => $name,
            'email' => $email,
            'department' => $department,
        ]);
    }

    public function updateDepartment(int $id, string $department )
    {
        $staff = Staff::find($id);

        return tap($staff)->update([
            'department' => $department,
        ]);
    }
}
