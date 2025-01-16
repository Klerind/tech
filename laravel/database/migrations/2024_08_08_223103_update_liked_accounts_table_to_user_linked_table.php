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
        Schema::table('user_liked_accounts', function (Blueprint $table) {
           $table->renameColumn('liked_account_id', 'user_liked_account_id');  
           $table->renameColumn('account_id', 'liked_account_id')->foreignId(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('user_liked_accounts', function (Blueprint $table) {
           $table->renameColumn('user_liked_account_id', 'liked_account_id');  
           $table->renameColumn('liked_account_id', 'account_id');
        });
    }
};
