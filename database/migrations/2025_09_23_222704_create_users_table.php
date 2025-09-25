<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email')->unique();
            $table->string('password_hash')->nullable();
            $table->string('sub')->unique()->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('job_title')->nullable();
            $table->string('avatar_url')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments','department_id')->nullOnDelete();
            $table->foreignId('role_id')->nullable()->constrained('roles','role_id')->nullOnDelete();
            $table->integer('google_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
