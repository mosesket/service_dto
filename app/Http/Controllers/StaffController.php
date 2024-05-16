<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\StaffDto;
use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use App\Services\StaffService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staff_service)
    {
        $this->staffService = $staff_service;
    }

    public function index(): JsonResponse
    {
        $staffs = $this->staffService->getStaffs();

        $staffs = StaffResource::collection($staffs);

        return response()->json([
            'message' => 'All staffs retrieved successfully.',
            'status' => 200,
            'data' => $staffs,
        ]);
    }

    public function create(CreateStaffRequest $request) : JsonResponse
    {
        try {
            // $staffDto = new StaffDto(
            //     $request->name,
            //     $request->email,
            //     $request->department,
            //     $request->public_2k,
            // );

            // $request->private_2billion was not used in the dto and may be used in other methods,

            $staffDto = StaffDto::fromCreateStaffRequest($request);
            $staff = $this->staffService->createMethod($staffDto);

            $staff = new StaffResource($staff);

            return response()->json([
                'message' => 'Staff created successfully.',
                'status' => 200,
                'data' => $staff,
            ], 201);
        } catch (Exception $e) {
            Log::channel('custom')->error('Failed to create customer: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => "An error occured. Please try again later",
            ]);
        }
    }

    public function update(UpdateStaffRequest $request): JsonResponse
    {
        $staffDto = StaffDto::fromUpdateStaffRequest($request);
        $staff = $this->staffService->updateDepartment($staffDto);

        $staff = new StaffResource($staff);

        return response()->json([
            'message' => 'Staff updated successfully.',
            'status' => 200,
            'data' => $staff,
        ]);
    }

    public function show(): JsonResponse
    {
        $staff = Staff::find(1);

        $staff = new StaffResource($staff);

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
