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
        Schema::create('contents', function (Blueprint $table) {           
            $table->uuid('id')->primary();
            $table->text('raw_content')->nullable();
            $table->text('rendered_content')->nullable();
            $table->morphs('contentable');
            $table->string('type')->default('page');
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
        Schema::dropIfExists('contents');
    }
};
