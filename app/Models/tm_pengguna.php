<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class tm_pengguna extends Model
{
    use HasFactory;
    use Timestamp;
    use SoftDeletes;

    protected $table = "tm_pengguna";

    protected $fillable = [
        'daftar_nomor_id',
        'nama',
        'alamat',
        'nomor_telepon',
    ];

}
