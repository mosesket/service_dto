<?php

use App\DataTransferObjects\StaffDto;
use Tests\TestCase;
use App\Services\StaffService;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetStaffs()
    {
        $staff1 = Staff::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT']);
        $staff2 = Staff::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'department' => 'HR']);

        $staffCollection = new Collection([$staff1, $staff2]);

        $mockStaff = Mockery::mock(Staff::class);
        $mockStaff->shouldReceive('with->get')->andReturn($staffCollection);

        $staffService = new StaffService();

        $staffs = $staffService->getStaffs();

        // Assertions
        $this->assertInstanceOf(Collection::class, $staffs);
        $this->assertEquals(2, $staffs->count());
    }

    public function testCreateMethod()
    {
        $staffDto = new StaffDto('john@example.com', 'John Doe', 'IT');

        $staffService = new StaffService();
        $staff = $staffService->createMethod($staffDto);

        $this->assertInstanceOf(Staff::class, $staff);
        $this->assertEquals('John Doe', $staff->name);
        $this->assertEquals('IT', $staff->department);
    }

    public function testGetStaffById()
    {
        $staff = Staff::create(['name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT']);

        $staffService = new StaffService();

        $retrievedStaff = $staffService->getStaffById($staff->id);

        $this->assertInstanceOf(Staff::class, $retrievedStaff);
        $this->assertEquals('John Doe', $retrievedStaff->name);
    }

    public function testUpdateDepartment()
    {
        $staff = Staff::create(['name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT']);

        $staffDto = new StaffDto('john@example.com', 'Updated Name', 'HR');

        $staffService = new StaffService();
        $updatedStaff = $staffService->updateDepartment($staff, $staffDto);

        $staff->refresh();

        // Assertions
        $this->assertInstanceOf(Staff::class, $updatedStaff);
        $this->assertEquals('Updated Name', $updatedStaff->name);
        $this->assertEquals('HR', $updatedStaff->department);
    }

    public function testDeleteStaff()
    {
        $staff = Staff::create(['name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT']);

        $staffService = new StaffService();

        $deleted = $staffService->deleteStaff($staff);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('staffs', ['id' => $staff->id]);
    }
}
