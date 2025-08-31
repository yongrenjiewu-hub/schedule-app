<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMeal extends Model
{
    use HasFactory;

    protected $table = 'm_meal';

    protected $primaryKey = 'meal_id';

    protected $fillable = [
        'food_name',
        'food_form',
        'food_time',
        'food_time_label',
    ];

    //リレーション（省略可：今回は一方向からのため必要ないが、双方向から取得するときは必要）
    //ptscheduleから取得されつためこっちが親になる
    public function mealSchedule()
    {
    return $this->hasOne(TPtschedule::class, 'meal_id', 'pt_schedule_id');
    }

    public function patients()
    {
    return $this->belongsToMany(MPatient::class, 'm_patient', 'pt_id', 'pt_id')
                ->withPivot('daily_schedule_date', 't_meal_id')
                ->withTimestamps();
    }

}
