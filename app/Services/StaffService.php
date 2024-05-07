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

    public function updateDepartment(StaffDto $staffDto): Staff
    {
        $staff = Staff::find($staffDto->id);

        return tap($staff)->update([
            'department' => $staffDto->department,
        ]);
    }
}
