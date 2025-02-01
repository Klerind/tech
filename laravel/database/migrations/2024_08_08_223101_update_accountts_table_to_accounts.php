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
        
        Schema::rename('accountts', 'accounts');
        Schema::table('accounts', function (Blueprint $table) {
           $table->renameColumn('accountt_id', 'account_id');  
           $table->renameColumn('accountt', 'account'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('accounts', 'accountts');
        Schema::table('accountts', function (Blueprint $table) {
           $table->renameColumn('account_id', 'accountt_id');  
           $table->renameColumn('account', 'accountt'); 
        });
    }
};
