<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_chitiethdt', function (Blueprint $table) {
            $table->id('id_chitiethdt');
            $table->bigInteger('id_trahang')->unsigned();
            $table->integer('id_sanpham');
            $table->integer('soluong');
            $table->foreign('id_trahang')
                ->references('id_trahang')
                ->on('tbl_trahang');
            $table->foreign('id_sanpham')
                ->references('id_sanpham')
                ->on('tbl_sanpham');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_form_details');
    }
};
