<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTreatmentkind extends Model
{
    use HasFactory;

    protected $table = 'm_treatment_kind';

    protected $primaryKey = 'treatment_kind_id';

    protected $fillable = [
        'category',
        'key',
        'value',
        'Ftreatment_date',
        'Streatment_date',
        'Ttreatment_date',
    ];
}
