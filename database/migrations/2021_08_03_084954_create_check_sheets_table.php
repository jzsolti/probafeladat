<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->index();
            $table->string('vehicle_name');
            $table->string('job');
            $table->text('comment')->nullable();
            $table->boolean('finished')->default(0);
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
        Schema::dropIfExists('check_sheets');
    }
}
