<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table)
        {
            $table->id();
            $table->bigInteger("equipment_type_id", false, true)->nullable();
            $table->string("serial_number");
            $table->string("description")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(["equipment_type_id", "serial_number"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
};
