<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_statuses', function (Blueprint $table) {
           $table->renameColumn('user_status', 'status_id')->mediumInteger('status_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_statuses', function (Blueprint $table) {
           $table->renameColumn('status_id', 'user_status')->string('user_status');
        });
    }
};
