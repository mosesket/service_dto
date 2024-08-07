<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'name' => $this->name,
            'email' => $this->email,
            'department' => $this->department,
            // 'department' => new DepartmentResource($this->whenLoaded('department')),
            // 'department' => $this->whenLoaded('department')->name,
            'payrolls' => PayrollResource::collection(
                $this->whenLoaded('payrolls')
            ),
        ];
    }
}
