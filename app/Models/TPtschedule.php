<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPtschedule extends Model
{
    use HasFactory;

    protected $table = 't_pt_schedule';

    protected $primaryKey = 'pt_schedule_id'; // テーブルの主キー名
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'pt_id',
        'meal_id',
        'care_kind_id',
        'medicine_id',
        'treatment_kind_id',
        'dialysis_id',
        'daily_schedule_date',
    ];

    //TptDialysisと紐付け（透析マスタへ）
    public function dialysis()
    {
        return $this->hasMany(TPtDialysis::class, 'pt_id', 'pt_id');
        //->where('daily_schedule_date', $this->daily_schedule_date); 
    }

    //TTreatmenkindと紐付け（治療マスタへ）
    public function treatmentkind()
    {
        return $this->hasMany(TTreatmentkind::class, 'pt_id', 'pt_id');
        //->where('daily_schedule_date', $this->daily_schedule_date); 
    }

    //TCarekindと紐付け（ケアマスタへ）
    public function carekind()
    {
        return $this->hasMany(TCarekind::class, 'pt_schedule_id', 'pt_schedule_id');
        //->where('daily_schedule_date', $this->daily_schedule_date); 
    }

    //MMealと紐付け
    public function meal()
    {
        return $this->belongsTo(MMeal::class, 'meal_id', 'meal_id');
    }

    public function meals()
    {
        return $this->belongsToMany(MMeal::class, 't_meal', 'pt_schedule_id', 'meal_id')
            //中間テーブルのカラムを取得する
            ->withPivot('t_meal_id') // ← 中間テーブルの主キーを取得
            ->withTimestamps();
    }


    // MMedicineとの紐付け
    public function medicines()
    {
        return $this->hasMany(TMedicine::class, 'pt_schedule_id', 'pt_schedule_id');
    }

}



