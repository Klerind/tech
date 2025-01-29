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
          $table->foreignId('field_group_id')->after('field_type');
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
              $table->removeColumn('field_group_id');
        });
    }
};
