<?php

use App\DataTransferObjects\StaffDto;
use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it retrieves all staffs', function () {
    Staff::factory()->count(5)->create();

    $staffs = StaffService::getStaffs();

    expect($staffs)->toHaveCount(5);
});

test('it retrieves a staff by ID', function () {
    $staff = Staff::factory()->create();

    $staffService = new StaffService();
    $retrievedStaff = $staffService->getStaffById($staff->id);

    expect($retrievedStaff)->toBeInstanceOf(Staff::class);
    expect($retrievedStaff->id)->toBe($staff->id);
});

test('it creates a staff', function () {
    $staffDto = new StaffDto(
        name: 'John Doe',
        email: 'john@example.com',
        department: 'HR',
    );

    $staffService = new StaffService();
    $staff = $staffService->createMethod($staffDto);

    expect($staff)->toBeInstanceOf(Staff::class);
    expect($staff->name)->toBe('John Doe');
    expect($staff->email)->toBe('john@example.com');
    expect($staff->department)->toBe('HR');
});

test('it updates staff department', function () {
    $staff = Staff::factory()->create([
        'email' => 'john@example.com',
        'name' => 'John Doe',
        'department' => 'IT',
    ]);

    $staffDto = new StaffDto(
        email: 'newmail@example.com',
        name: 'new name',
        department: 'newHR',
    );

    $staffService = new StaffService();
    $updatedStaff = $staffService->updateDepartment($staff, $staffDto);

    expect($staff->name)->toBe('new name');
    expect($staff->email)->toBe('john@example.com');
    expect($staff->department)->toBe('newHR');
});

test('it deletes a staff', function () {
    $staff = Staff::factory()->create();

    $staffService = new StaffService();
    $staffService->deleteStaff($staff);

    expect(Staff::find($staff->id))->toBeNull();
});
