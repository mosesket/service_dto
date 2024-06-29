<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\StaffDto;
use App\Http\Requests\FindStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use App\Services\StaffService;
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
        try {
            $staffs = $this->staffService->getStaffs();
            $staffs = StaffResource::collection($staffs);

            return response()->json([
                'message' => 'All staffs retrieved successfully.',
                'status' => 200,
                'data' => $staffs,
            ]);
        } catch (\Exception $e) {
            Log::channel('custom')->error('Failed to retrieve all staffs: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve all staffs. Please try again later.',
            ]);
        }
    }

    public function create(StoreStaffRequest $request): JsonResponse
    {
        try {
            // $staffDto = new StaffDto(
            //     $request->name,
            //     $request->email,
            //     $request->department,
            //     $request->public_2k,
            // );

            $staffDto = StaffDto::fromStoreStaffRequest($request);
            $staff = $this->staffService->createMethod($staffDto);

            $staff = new StaffResource($staff);

            return response()->json([
                'message' => 'Staff created successfully.',
                'status' => 200,
                'data' => $staff,
            ], 201);
        } catch (\Exception $e) {
            Log::channel('custom')->error('Failed to create staff: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Failed to create staff. Please try again later.',
            ]);
        }
    }

    public function update(UpdateStaffRequest $request): JsonResponse
    {
        try {
            $staffId = $request->validated('staff_id');
            $staff = $this->staffService->getStaffById($staffId);

            if (!$staff) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Staff not found.',
                ]);
            }

            $staffDto = StaffDto::fromUpdateStaffRequest($request, $staff);
            $updateStaff = $this->staffService->updateDepartment($staff, $staffDto);

            $staffResource = new StaffResource($updateStaff);

            return response()->json([
                'message' => 'Staff updated successfully.',
                'status' => 200,
                'data' => $staffResource,
            ]);
        } catch (\Exception $e) {
            Log::channel('custom')->error('Failed to update staff: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Failed to update staff. Please try again later.',
            ]);
        }
    }

    public function show(FindStaffRequest $request): JsonResponse
    {
        try {
            $staffId = $request->validated('staff_id');
            $staff = $this->staffService->getStaffById($staffId);

            $staffResource = new StaffResource($staff);

            return response()->json([
                'message' => 'Staff retrieved successfully.',
                'status' => 200,
                'data' => $staffResource,
            ]);
        } catch (\Exception $e) {
            Log::channel('custom')->error('Failed to retrieve staff: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve staff. Please try again later.',
            ]);
        }
    }

    public function destroy(FindStaffRequest $request): JsonResponse
    {
        try {
            $staffId = $request->validated('staff_id');
            $staff = $this->staffService->getStaffById($staffId);

            $this->staffService->deleteStaff($staff);

            return response()->json([
                'message' => 'Staff deleted successfully.',
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            Log::channel('custom')->error('Failed to delete staff: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete staff. Please try again later.',
            ]);
        }
    }
}
