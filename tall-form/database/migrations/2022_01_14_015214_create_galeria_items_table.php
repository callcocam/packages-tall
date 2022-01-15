<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_items', function (Blueprint $table) {
            $table->uuid('id')->primary();        
            $table->string('name', 255)->nullable();   
            $table->string('slug', 255)->nullable();   
            $table->string('link', 255)->nullable();   
            $table->string('source', 255)->nullable();   
            $table->string('disk', 25)->nullable();   
            $table->string('size', 50)->nullable();   
            $table->string('mime_type', 100)->nullable();   
            $table->integer('ordering')->nullable();   
            $table->foreignUuid('galeria_id')->nullable()->constrained('galerias')->cascadeOnDelete();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('status_id')->nullable()->constrained('statuses')->cascadeOnDelete();
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
        Schema::dropIfExists('galeria_items');
    }
}
