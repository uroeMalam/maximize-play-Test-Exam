<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class th_mlm extends Model
{
    use HasFactory;
    use Timestamp;
    use SoftDeletes;

    protected $table = "th_mlm";

    protected $fillable = [
        'id_pengguna',
        'id_downline',
        'keterangan',
    ];

    
    public function joinData($id)
    {
        return DB::table($this->table)
            ->select(
                'pg.daftar_nomor_id as id_pengguna_baru',
                'pg.nama as nama_pengguna',
                'pg.alamat as alamat_pengguna',
                'pg.nomor_telepon as nomor_telepon',

                'tm_pengguna.daftar_nomor_id',
                'tm_pengguna.nama',
                'tm_pengguna.alamat',
                'tm_pengguna.nomor_telepon',

                'th_mlm.id_pengguna',
                'th_mlm.id_downline',
            )
            ->leftJoin('tm_pengguna', 'th_mlm.id_pengguna', '=', 'tm_pengguna.id')
            ->leftJoin('tm_pengguna as pg', 'th_mlm.id_downline', '=', 'pg.id')
            ->where('th_mlm.id_downline', $id)
            ->first();
    }
    
    public function Downline($id)
    {
        return DB::table($this->table)
            ->select(
                'tm_pengguna.daftar_nomor_id as id',
                'tm_pengguna.nama',
            )
            ->leftJoin('tm_pengguna', 'th_mlm.id_pengguna', '=', 'tm_pengguna.id')
            ->where('th_mlm.id_pengguna', $id)
            ->get();
    }

}
