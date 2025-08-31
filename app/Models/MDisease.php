<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDisease extends Model
{
    use HasFactory;

    protected $table = 'm_disease';

    protected $primaryKey = 'disease_id';

    protected $fillable = [
        'disease_name',
    ];

    public function patients()
{
    return $this->hasMany(MPatient::class, 'disease_id', 'disease_id');
}

}
