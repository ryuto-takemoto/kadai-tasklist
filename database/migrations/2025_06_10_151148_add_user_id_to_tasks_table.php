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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('status'); // user_idカラムを追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // 外部キー制約
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // 外部キー制約を削除
            $table->dropColumn('user_id'); // user_idカラムを削除
        });
    }
};