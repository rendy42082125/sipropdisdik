<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('status_id'); // Tambahkan kolom untuk FK status_id
            $table->unsignedBigInteger('id_sekolah'); // Tambahkan kolom untuk FK id_sekolah
            $table->timestamps();

            // Definisikan foreign key constraint
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah')->onDelete('RESTRICT')->onUpdate('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
