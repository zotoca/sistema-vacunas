<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonVaccinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_vaccination', function (Blueprint $table) {
            $table->id();
            $table->date("vaccination_date");

            $table->string("dose");
            
            $table->string("lot_number")
                ->nullable();
            
            $table->boolean("is_vaccinated")
                ->default(false);
            
            $table->unsignedBigInteger("person_id");
            $table->foreign("person_id")
                ->references("id")
                ->on("persons")
                ->onDelete("cascade");
                
            $table->unsignedBigInteger("vaccination_id");
            $table->foreign("vaccination_id")
                ->references("id")
                ->on("vaccinations")
                ->onDelete("cascade");

                        
            

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
        Schema::dropIfExists('person_vaccination');
    }
}
