<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();

            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->string('first_name');

            $table->string('last_name');

            $table->string('middle_name');

            $table->string('full_name');

            $table->date('born_date');

            $table->string('photo_url')->nullable();

            $table->string('citizenship');

            $table->string('nation');

            $table->string('phone_number');

            $table->string('additional_phone_number')->nullable();

            $table->string('about', 4096);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
