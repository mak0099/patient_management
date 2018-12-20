<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempPrescriptionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_prescription_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->integer('test_id');
            $table->boolean('deletation_status')->default(FALSE);
            $table->integer('created_by');
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
        Schema::dropIfExists('temp_prescription_tests');
    }
}
