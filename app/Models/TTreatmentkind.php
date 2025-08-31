<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTreatmentkind extends Model
{
    use HasFactory;

    protected $table = 't_treatment_kind';

    protected $primaryKey = 't_treatment_kind_id';

    protected $fillable = [
        'pt_id',
        'treatment_kind_id',
        'pt_schedule_id',
        'daily_schedule_date',
    ];

    //MTreatmentkindと紐付けptschduleからたどれる
    public function treatmentkindMaster()
    {
        return $this->belongsTo(MTreatmentkind::class, 'treatment_kind_id', 'treatment_kind_id');
    }


}
