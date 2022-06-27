<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('statuses')) {
            Schema::create('statuses', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name',191)->nullable();
                $table->string('slug', 191)->unique();
                $table->string('type',255)->default('general')->nullable();
                $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('users', function (Blueprint $table) {
                $table->foreignUuid('status_id')->nullable()->constrained('statuses')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
