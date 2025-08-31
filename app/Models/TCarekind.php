<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCarekind extends Model
{
    use HasFactory;

    protected $table = 't_care_kind';

    protected $primaryKey = 't_care_kind_id';

    
    
    protected $fillable = [
        'pt_id',
        'care_kind_id',
        'pt_schedule_id',        
        'daily_schedule_date',    
    ];


    //MCarekindと紐付けptschduleからたどれる
    public function carekindMaster()
    {
        return $this->belongsTo(MCarekind::class, 'care_kind_id', 'care_kind_id');
    }

    // App\Http\Controllers\TPtscheduleController.php

    // App\Models\TCarekind.php

    // App\Models\TTreatmentkind.php


}
