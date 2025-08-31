<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPtDialysis extends Model
{
    use HasFactory;

    protected $table = 't_pt_dialysis';

    protected $primaryKey = 'pt_dialysis_id';

    protected $fillable = [
        'pt_id',
        't_pt_dialysis_part'
    ];

    //Mdialysisと紐付けすることでptschduleからたどれる
    public function dialysisMaster()
    {
        return $this->belongsTo(Mdialysis::class, 't_pt_dialysis_part', 'dialysis_id');
    }


}
