<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained()->unique()->onDelete('cascade');
            $table->string('filename');
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}

