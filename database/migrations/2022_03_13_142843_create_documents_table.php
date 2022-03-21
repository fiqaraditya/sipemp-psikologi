<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('mahasiswa_id')->primary();
            $table->string('email_pr1')->nullable();
            $table->string('email_pr2')->nullable();
            $table->integer('status_rekomendasi')->nullable();
            $table->foreignId('r1_id')->nullable();
            $table->foreignId('r2_id')->nullable();
            $table->string('file_lk_path')->nullable();
            $table->string('file_psikotest_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
