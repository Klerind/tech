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
      Schema::table('tests', function (Blueprint $table) {
      //   $table->renameColumn('test_grup_id', 'test_group_id');
      //   $table->foreignId('right_answer_id')
      //   ->after('answer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('tests', function (Blueprint $table) {
      //   $table->renameColumn('test_group_id','test_grup_id');
      //   $table->removeColumn('right_answer_id');
        });
    }
};
