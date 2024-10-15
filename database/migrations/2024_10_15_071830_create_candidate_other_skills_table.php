<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class {
    public function up(): void
    {
        Schema::create('candidate_other_skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('level');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_other_skills');
    }
};
