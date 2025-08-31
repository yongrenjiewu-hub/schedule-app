<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mdialysis extends Model
{
    use HasFactory;

    protected $table = 'm_dialysis';

    protected $primaryKey = 'dialysis_id';

    protected $fillable = [
        'part',
        'dialysis_day',
        'dialysis_date',
    ];
}
