<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMedicine extends Model
{
    use HasFactory;

    protected $table = 't_medicine';

    protected $primaryKey = 't_medicine_id';

    protected $fillable = [
        'pt_schedule_id',
        'medicine_id'
    ];

    //MMedicineと紐付け
    public function medicineMaster()
    {
        return $this->belongsTo(MMedicine::class, 'medicine_id', 'medicine_id');
    }

}
