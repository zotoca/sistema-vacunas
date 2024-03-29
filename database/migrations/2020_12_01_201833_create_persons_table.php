<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();

            $table->string("first_name");
            $table->string("last_name");
            $table->string("dni");
            $table->string("image_url")->nullable();
            $table->enum("gender",['masculino','femenino']);
            $table->date("birthday");
            $table->string("phone_number");
            $table->string("address");

            $table->unsignedBigInteger("father_id")->nullable();
            $table->foreign("father_id")
                ->references("id")
                ->on("persons");
            
            $table->unsignedBigInteger("mother_id")->nullable();
            $table->foreign("mother_id")
                ->references("id")
                ->on("persons");
                
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
        Schema::dropIfExists('persons');
    }
}
