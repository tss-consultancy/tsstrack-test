<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveLicenseEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_license_entries', function (Blueprint $table) {
            $table->id();
            $table->string('unit'); // Enter Unit
            $table->string('owner'); // Enter Owner
            $table->decimal('rent_amount', 10, 2); // Enter Rent Amount
            $table->decimal('deposit_amount', 10, 2); // Enter Deposit Amount
            $table->date('from_date'); // Enter From Date
            $table->date('to_date'); // Enter To Date
            $table->date('escalation_date'); // Enter Escalation Date
            $table->decimal('escalation_percentage', 5, 2); // Enter Escalation (%)
            $table->date('commitment_date'); // Enter Date of Commitment
            $table->date('contract_date'); // Enter Date of Contract
            $table->text('remarks')->nullable(); // Enter Remarks (optional)
            $table->timestamps(); // To track creation and update times
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_license_entries');
    }
}
