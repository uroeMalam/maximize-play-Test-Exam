<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThMlm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Th_Mlm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna')
                ->constrained('Tm_Pengguna')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('id_downline')
                ->constrained('Tm_Pengguna')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('keterangan');
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
        Schema::dropIfExists('Th_Mlm');
    }
}
