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
        Schema::table('liked_accounts', function (Blueprint $table) {
           $table->renameColumn('liked_account', 'account_id')->mediumInteger('account_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liked_accounts', function (Blueprint $table) {
           $table->renameColumn('account_id', 'liked_account')->string('liked_account');
        });
    }
};
