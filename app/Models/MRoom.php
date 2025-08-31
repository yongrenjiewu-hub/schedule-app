<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRoom extends Model
{
    use HasFactory;

    protected $table = 'm_room';

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_name',
        'limited',
    ];

}
