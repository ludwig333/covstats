<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(); 
            $table->string('name')->nullable();     
            $table->integer('cases')->nullable();      
            $table->string('death')->nullable();   
            $table->string('recovered')->nullable(); 
            $table->string('today_cases')->nullable();     
            $table->integer('today_death')->nullable();      
            $table->string('today_recovered')->nullable();   
            $table->string('active')->nullable(); 
            $table->string('mild')->nullable();     
            $table->integer('critical')->nullable();      
            $table->string('update')->nullable();                                       
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
        Schema::dropIfExists('countries');
    }
}
