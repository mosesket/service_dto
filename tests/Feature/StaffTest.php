<?php

use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;

uses(RefreshDatabase::class);

test('it retrieves all staffs', function () {
    Staff::factory()->count(5)->create();

    $response = $this->getJson('/api/staffs');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'status',
            'data' => [
                '*' => [
                    'name',
                    'email',
                    'department',
                    'payrolls',
                ],
            ],
        ]);
});

test('it creates a staff', function () {
    $staffService = mock(StaffService::class, function (MockInterface $mock) {
        $mock->shouldReceive('createMethod')->andReturn(
            Staff::factory()->make([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'department' => 'HR',
            ])
        );
    });

    $this->app->instance(StaffService::class, $staffService);

    $response = $this->postJson('/api/staffs/create', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'department' => 'HR',
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => 'Staff created successfully.',
            'status' => 200,
        ]);
});

test('it shows a staff', function () {
    $staff = Staff::factory()->create();

    $response = $this->postJson('/api/staffs/staff', ['staff_id' => $staff->id]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Staff retrieved successfully.',
            'status' => 200,
            'data' => [
                // 'id' => $staff->id,
                'name' => $staff->name,
                'email' => $staff->email,
                'department' => $staff->department,
            ]
        ]);
});

it('can update an existing staff', function () {
    $staff = Staff::factory()->create();

    $updatedData = [
        'staff_id' => $staff->id,
        'department' => 'Finance',
    ];

    $staffService = mock(StaffService::class, function (MockInterface $mock) use ($staff, $updatedData) {
        $mock->shouldReceive('getStaffById')->with($staff->id)->andReturn($staff);
        $mock->shouldReceive('updateDepartment')->with($staff, Mockery::on(function ($arg) use ($updatedData) {
            return $arg->department === $updatedData['department'];
        }))->andReturn(tap($staff)->update(['department' => $updatedData['department']]));
    });


    $this->app->instance(StaffService::class, $staffService);

    $response = $this->putJson('/api/staffs/update', $updatedData);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Staff updated successfully.',
            'status' => 200,
            'data' => [
                'name' => $staff->name,
                'email' => $staff->email,
                'department' => 'Finance',
            ]
        ]);

    $this->assertDatabaseHas('staffs', [
        'id' => $staff->id,
        'name' => $staff->name,
        'email' => $staff->email,
        'department' => 'Finance',
    ]);
});

test('it deletes a staff', function () {
    $staff = Staff::factory()->create();

    $response = $this->deleteJson('/api/staffs/remove', [
        'staff_id' => $staff->id,
    ]);

    $response->assertStatus(200);

    $this->assertDatabaseMissing('staffs', [
        'id' => $staff->id,
    ]);
});
