<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCarekind extends Model
{
    use HasFactory;

    protected $table = 'm_care_kind';

    protected $primaryKey = 'care_kind_id';

    protected $fillable = [
        'category',
        'key',
        'value',
        'Fcare_date',
        'Scare_date',
        'Tcare_date',
    ];

    
}
