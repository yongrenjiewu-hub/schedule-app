<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMedicalrecord extends Model
{
    use HasFactory;

    protected $table = 't_medical_record';

    protected $primaryKey = 'record_id';

    protected $fillable = [
        'pt_id',       // 他のカラムがあるなら
        'pt_record',   // ← これを追加
        // 他にも必要なカラムがあればここに追加
    ];
    //MPatientとのリレーション（子）
    public function patient()
    {
        return $this->belongsTo(MPatient::class, 'pt_id', 'pt_id');
    }
}
