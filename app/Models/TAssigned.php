<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAssigned extends Model
{
    use HasFactory;

    protected $table = 't_assigned';

    protected $fillable = ['user_id', 'pt_id'];

    public function patient()
    {
        return $this->belongsTo(MPatient::class, 'pt_id', 'pt_id');
    }

    public function user()
    {
        return $this->belongsTo(MUser::class);
    }
}
