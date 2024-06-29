<?php

namespace App\DataTransferObjects;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;

readonly class StaffDto
{
    public function __construct(
        public string $email,
        public string $name,
        public ?string $department = null,
    ) {
    }

    public static function fromStoreStaffRequest(StoreStaffRequest $request): StaffDto
    {
        return new self(
            $request->validated('email'),
            $request->validated('name'),
            $request->validated('department'),
        );
    }

    public static function fromUpdateStaffRequest(UpdateStaffRequest $request, Staff $staff): StaffDto
    {
        return new self(
            $staff->email,
            $staff->name ?? $request->validated('name'),
            $staff->department ?? $request->validated('department'),
        );
    }
}
