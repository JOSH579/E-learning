<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('module_id')->nullable()->after('id');
        });

        $lessons = DB::table('lessons')->select('id', 'course_id')->get();
        $moduleIdsByCourse = [];

        foreach ($lessons as $lesson) {
            $courseId = $lesson->course_id;

            if (! isset($moduleIdsByCourse[$courseId])) {
                $moduleIdsByCourse[$courseId] = DB::table('modules')->insertGetId([
                    'course_id' => $courseId,
                    'title' => 'Main',
                    'description' => null,
                    'position' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('lessons')->where('id', $lesson->id)->update([
                'module_id' => $moduleIdsByCourse[$courseId],
            ]);
        }

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropIndex(['course_id', 'position']);
            $table->dropColumn('course_id');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('module_id')->references('id')->on('modules')->cascadeOnDelete();
            $table->index(['module_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->after('id');
        });

        $modules = DB::table('modules')->select('id', 'course_id')->get();

        foreach ($modules as $module) {
            DB::table('lessons')->where('module_id', $module->id)->update([
                'course_id' => $module->course_id,
            ]);
        }

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
            $table->dropIndex(['module_id', 'position']);
            $table->dropColumn('module_id');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->index(['course_id', 'position']);
        });
    }
};
