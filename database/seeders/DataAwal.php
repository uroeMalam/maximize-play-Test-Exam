<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataAwal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('tm_pengguna')->insert([
            'id'=>1,
            'daftar_nomor_id'=>'MLM0001',
            'nama'=>'The President',
            'alamat'=>'Indonesia',
            'nomor_telepon'=>'1000000001',
            'created_at'=>NULL,
            'updated_at'=>'2021-12-21 21:48:46',
            'deleted_at'=>null
            ] );
        
    }
}
