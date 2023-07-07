<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rank_id')->constrained('rank_settings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('account_group_id')->constrained('account_groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('login');
            $table->string('member_name');
            $table->string('mobile_number');
            $table->string('email');
            NestedSet::columns($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
