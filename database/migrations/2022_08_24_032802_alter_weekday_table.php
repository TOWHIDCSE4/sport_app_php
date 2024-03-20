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
        Schema::table('weekdays', function (Blueprint $table) {
            $table->tinyInteger('weight')->default(0);
        });
        Schema::table('venue_booking', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
        });
        Schema::table('venue_booking', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable()->change();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('venue_book_id')->nullable()->index();
            $table->foreign('venue_book_id')->references('id')->on('venue_booking')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekdays', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['venue_book_id']);
            $table->dropColumn('venue_book_id');
        });
    }
};
