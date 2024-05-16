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

            // including in DTO
            'public_2k' => $this->department,
            // not including in DTO
            'private_2billion' => $this->department,

            // 'fullname' => $this->firstname . ' ' . $this->lastname,
            'fullname' => $this->name . $this->middlename . ' ' . 'surname',

            'payrolls' => PayrollResource::collection(
                $this->whenLoaded('payrolls')
            ),
        ];
    }
}
