<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function appoinments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
