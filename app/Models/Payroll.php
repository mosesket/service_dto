<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship with Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
