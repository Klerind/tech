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
        Schema::table('users_forms_fields', function (Blueprint $table) {
          $table->string('field_type', 100)
                ->after('field_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_forms_fields', function (Blueprint $table) {
           $table->dropColumn('field_type');
        });
    }
};
