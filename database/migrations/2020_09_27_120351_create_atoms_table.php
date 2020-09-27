<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atoms', function (Blueprint $table) {
            $table->id();
            $table->string('literal');
            $table->foreignId('predicate_id')->constrained('predicates');
            $table->foreignId('predicates_list_id')->constrained('predicates');
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
        Schema::dropIfExists('atoms');
    }
}
