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
        $staff = Staff::create([
            'name' => $name,
            'email' => $email,
            'department' => $department,
        ]);

        return $staff;
    }

    public function updateDepartment(int $id, string $department )
    {
        $staff = Staff::find($id);

        $staff->update([
            'department' => $department,
        ]);

        return $staff;
    }

}
