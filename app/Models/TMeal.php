<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMeal extends Model
{
    use HasFactory;

    protected $table = 't_meal';

    protected $primaryKey = 't_meal_id';
    
    protected $fillable = [
        'pt_schedule_id',
        'meal_id',
        'daily_schedule_date',
        'pt_id'
    ];


    public function meals()
    {
    return $this->belongsToMany(MMeal::class, 't_meal', 'pt_id', 'meal_id')
                ->withPivot('daily_schedule_date', 't_meal_id')
                ->withTimestamps();
    }

}
