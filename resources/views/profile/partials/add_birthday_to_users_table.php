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
        Schema::table('users', function (Blueprint $table) {
            // เพิ่มคอลัมน์ birthdate ชนิดข้อมูลเป็น DATE
            // nullable() คืออนุญาตให้มีค่าว่างได้ (สำหรับ user ที่มีอยู่แล้ว)
            // after('email') คือให้สร้างคอลัมน์นี้ต่อจากคอลัมน์ email (เพื่อความเป็นระเบียบ)
            $table->date('birthdate')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // คำสั่งสำหรับตอน rollback migration (ลบคอลัมน์ที่สร้างไป)
            $table->dropColumn('birthdate');
        });
    }
};