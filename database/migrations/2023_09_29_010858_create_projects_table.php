<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name');
            $table->text('description');
            $table->string('repository_url');
            $table->string('repository_id');

            $table->text('abandonment_reason')->nullable(true);
            $table->text('project_future')->nullable(true);
            $table->string('project_abandonment_status')->nullable(true);
            $table->string('status')->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
