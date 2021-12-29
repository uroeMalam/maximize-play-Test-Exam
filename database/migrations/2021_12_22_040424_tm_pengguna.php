<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TmPengguna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tm_Pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('daftar_nomor_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tm_Pengguna');
    }
}
