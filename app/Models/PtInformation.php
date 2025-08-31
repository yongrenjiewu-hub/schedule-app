<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtInformation extends Model
{
    use HasFactory;

    protected $table = 'pt_information';  // テーブル名（複数形じゃない場合は指定）

    protected $primaryKey = 'pt_id';      // 主キーが pt_id の場合は指定

    public $timestamps = false;           // created_at, updated_at を使わない場合

    protected $fillable = [
        'pt_id',
        'some_column_1',
        'some_column_2',
        // 必要なカラム名を列挙
    ];
}
