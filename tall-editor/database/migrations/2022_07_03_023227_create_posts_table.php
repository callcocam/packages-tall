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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->text('content');
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();            
            if (Schema::hasTable('statuses')) {           
                $table->foreignUuid('status_id')->nullable()->constrained('statuses')->cascadeOnDelete();
            }
            else{
                $table->enum('status_id',['draft','published'])->nullable()->comment("Situação")->default('published');
            }
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
