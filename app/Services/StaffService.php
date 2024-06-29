<?php

namespace App\Services;

use App\DataTransferObjects\StaffDto;
use App\Models\Payroll;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

class StaffService
{
    public static function getStaffs(): Collection
    {
        // $staffs = Staff::all();
        $staffs = Staff::with('payrolls')->get();

        return $staffs;
    }

    public function createMethod(StaffDto $staffDto): Staff
    {
        $staff = Staff::create([
            'name' => $staffDto->name,
            'email' => $staffDto->email,
            'department' => $staffDto->department,
        ]);

        // // Create a payroll for the new staff member
        // $payroll = new Payroll([
        //     'period' => 'monthly',
        //     'amount' => 2000.00,
        // ]);

        // $staff->payrolls()->save($payroll);

        return $staff;
    }

    public function getStaffById(int $id): ?Staff
    {
        return Staff::find($id);
    }

    public function updateDepartment(Staff $staff, StaffDto $staffDto): Staff
    {
        return tap($staff)->update([
            'name' => $staffDto->name,
            'department' => $staffDto->department,
        ]);
    }

    public function deleteStaff(Staff $staff): bool
    {
        return $staff->delete();
    }
}
