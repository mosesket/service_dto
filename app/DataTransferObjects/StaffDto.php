<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;

readonly class StaffDto
{
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $department = null,
    ) {
    }

    public static function fromCreateStaffRequest(CreateStaffRequest $request): StaffDto
    {
        return new self(
            null,
            $request->validated('name'),
            $request->validated('email'),
            $request->validated('department'),
        );
    }

    public static function fromUpdateStaffRequest(UpdateStaffRequest $request): StaffDto
    {
        return new self(
            $request->validated('id'),
            null,
            null,
            $request->validated('department'),
        );
    }
}
