<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use App\Services\StaffService;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index()
    {
        $staffService = new StaffService;

        $staffs = $staffService->getStaffs();

        $staffs = StaffResource::collection($staffs);

        return $staffs;

        // return response()->json([
        //     'message' => 'Settings retrieved successfully.',
        //     'status' => 200,
        //     'data' => $staffs,
        // ]);
    }

    public function create(CreateStaffRequest $request)
    {
        $staff = $this->staffService->createMethod(
            $request->validated('name'),
            $request->validated('email'),
            $request->validated('department'),
        );

        $staff = new StaffResource(
            $staff
        );

        return $staff;
    }

    public function update($id, UpdateStaffRequest $request)
    {
        $staff = $this->staffService->updateDepartment(
            $id,
            $request->validated('department')
        );

        $staff = new StaffResource(
            $staff
        );

        return $staff;
    }

    public function show(Staff $staff)
    {
        $staff = Staff::find(1);

        $staff = new StaffResource(
            $staff
        );

        return $staff;
    }

    public function destroy(Staff $staff)
    {
        //
    }
}
