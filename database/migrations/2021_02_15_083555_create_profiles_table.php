<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('name',50)->nullable();
            $table->string('family',50)->nullable();
            $table->integer('age')->nullable();
            $table->string('education',50)->nullable();
            $table->string('job',50)->nullable();
            $table->string('biography',2000)->nullable();
            $table->string('Favorits-reading',50)->nullable();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
