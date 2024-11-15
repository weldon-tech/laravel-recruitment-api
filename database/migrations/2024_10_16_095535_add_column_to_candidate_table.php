<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::table('candidates', function (Blueprint $table) {
            $table->string('education_level')->default('');
            $table->boolean('has_work_place')->default(false);
            $table->string('chat_id')->default('');
            $table->string('status')->default('CREATED');
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('education_level');
            $table->dropColumn('has_work_place');
            $table->dropColumn('chat_id');
            $table->dropColumn('status');
        });
    }
};
