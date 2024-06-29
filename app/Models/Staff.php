<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $guarded = [];

    // Define the relationship with Payroll
    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
