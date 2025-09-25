<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Thay đổi kiểu dữ liệu của cột google_id từ integer thành string
            $table->string('google_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hoàn tác thay đổi nếu cần
            $table->integer('google_id')->nullable()->change();
        });
    }
};
