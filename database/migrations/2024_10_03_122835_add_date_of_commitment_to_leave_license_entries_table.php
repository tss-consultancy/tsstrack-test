<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateOfCommitmentToLeaveLicenseEntriesTable extends Migration
{
    public function up()
    {
        Schema::table('leave_license_entries', function (Blueprint $table) {
            $table->date('date_of_commitment')->nullable(); // Add this line
        });
    }

    public function down()
    {
        Schema::table('leave_license_entries', function (Blueprint $table) {
            $table->dropColumn('date_of_commitment');
        });
    }
}
