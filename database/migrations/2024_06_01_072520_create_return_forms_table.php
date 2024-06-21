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
        Schema::create('tbl_trahang', function (Blueprint $table) {
            $table->id('id_trahang');
            $table->integer('tonggiatra');
            $table->integer('tongsoluong');
            $table->integer('id_hoadonxuat');
            $table->foreign('id_hoadonxuat')
                ->references('id_hoadonxuat')
                ->on('tbl_hoadonxuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_forms');
    }
};
