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

        return response()->json([
            'message' => 'All staffs retrieved successfully.',
            'status' => 200,
            'data' => $staffs,
        ]);
    }

    public function create(CreateStaffRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Staff created successfully.',
            'status' => 200,
        ], 201);

        // $staff = $this->staffService->createMethod(
        //     StaffDto::fromCreateStaffRequest($request)
        // );

        // $staff = new StaffResource(
        //     $staff
        // );

        // return response()->json([
        //     'message' => 'Staff created successfully.',
        //     'status' => 200,
        //     'data' => $staff,
        // ], 201);
    }

    public function update(UpdateStaffRequest $request): JsonResponse
    {
        $staff = $this->staffService->updateDepartment(
            StaffDto::fromUpdateStaffRequest($request)
        );

        $staff = new StaffResource(
            $staff
        );

        return response()->json([
            'message' => 'Staff updated successfully.',
            'status' => 200,
            'data' => $staff,
        ], 201);
    }

    public function show(Staff $staff): JsonResponse
    {
        $staff = Staff::find(1);

        $staff = new StaffResource(
            $staff
        );

        return response()->json([
            'message' => 'Staff retrieved successfully.',
            'status' => 200,
            'data' => $staff,
        ]);
    }

    public function destroy(Staff $staff)
    {
        //
    }
}
