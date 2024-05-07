<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\StaffDto;
use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index(): JsonResponse
    {
        $staffService = new StaffService;

        $staffs = $staffService->getStaffs();

        $staffs = StaffResource::collection($staffs);

        // return $staffs;

        return response()->json([
            'message' => 'Settings retrieved successfully.',
            'status' => 200,
            'data' => $staffs,
        ]);
    }

    public function create(CreateStaffRequest $request)
    {
        $staff = $this->staffService->createMethod(
            StaffDto::fromCreateStaffRequest($request)
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
            StaffDto::fromUpdateStaffRequest($request)
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
