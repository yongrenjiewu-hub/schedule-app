<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMedicine extends Model
{
    use HasFactory;

    protected $table = 'm_medicine';

    protected $primaryKey = 'medicine_id';

    protected $fillable = [
        'kinds',
        'drug_name',
        'usage',
        'dose',
        'medicine_time',
        'medicine_time_label',
    ];

    
    // App\Models\MPatient.php
    public function ptSchedules()
    {
    return $this->hasMany(TPtschedule::class);
    }

    public function todayPtSchedules()
    {
        return $this->hasMany(TPtschedule::class)->whereDate('daily_schedule_date', Carbon::today());
    }



}
