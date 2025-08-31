<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TPtschedule;

class MPatient extends Model
{
    use HasFactory;

    //テーブル名を単数形で設定
    protected $table = 'm_patient';
    //primary_key指定。これによりpt_idがautoincrumentする
    protected $primaryKey = 'pt_id';

    //ptscheduleとのリレーション
    public function ptSchedules()
    {
        return $this->hasMany(TPtschedule::class, 'pt_id', 'pt_id');
    }
    //diseaseとのリレーション
    public function disease()
    {
    return $this->belongsTo(MDisease::class, 'disease_id', 'disease_id');
    }

    //TMedicalrecordとのリレーション（親）は複数のrecordを持つ
    public function records()
    {
    return $this->hasMany(TMedicalrecord::class, 'pt_id', 'pt_id');
    }

    //MMealとのリレーション
    public function meals()
    {
    return $this->belongsToMany(MMeal::class, 'm_meal', 'pt_id', 'meal_id')
                ->withPivot('daily_schedule_date', 't_meal_id')
                ->withTimestamps();
    }

    // 一括代入可能なカラムを指定
    protected $fillable = [
        'room_id',
        'pt_name',
        'sex',
        'blood_type',
        'birthday',  
        'disease_id',
        'tell_number',
        'key_person',
        'Dr_name',
    ];

    public function ptSchedulesAll()
    {
        return $this->hasMany(TPtschedule::class, 'pt_id', 'pt_id');
    }

}
