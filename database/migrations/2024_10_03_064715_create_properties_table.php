<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('unit'); // Property unit
            $table->string('owner'); // Owner name
            $table->decimal('rent_amount', 10, 2); // Rent amount
            $table->decimal('escalation', 5, 2); // Escalation percentage
            // Add any other relevant fields here
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
