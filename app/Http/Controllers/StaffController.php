<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Resources\StaffResponse;
use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // protected $staffService;

    // public function __construct(StaffService $staffService)
    // {
    //     $this->staffService = $staffService;
    // }

    public function __construct(
        protected StaffService $staffService,
    ) {}

    public function index()
    {
        $staffService = new StaffService;

        $staffs = $staffService->getStaffs();

        return new StaffResponse($staffs);

        // return $staffs;
    }

    public function create(CreateStaffRequest $request)
    {
        dd($request);

        $name = 'name';
        $email = 'email2';
        $department = 'department';

        // $staffService = new StaffService;

        $staff = $this->staffService->createMethod(
            $name,
            $email,
            $department,
        );

        dd($staff);
    }

    public function store($id, UpdateStaffRequest $request)
    {

        // $department = $request->department;
        $department = 'new-----department';

        $staff = $this->staffService->updateDepartment($id, $department);

        dd($staff);
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
