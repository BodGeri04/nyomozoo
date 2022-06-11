<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('advertisements');
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('name');
            $table->date('disappeared');
            $table->string('zip_number');
            $table->string('image_attach')->nullable();
            $table->string('animal_type');
            $table->text('comment')->nullable();
            $table->string('characteristics');
            $table->string('pre_phone_number');
            $table->string('phone_number');
            $table->boolean('chip')->nullable()->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('sex', ['Male', 'Female']);
            $table->boolean('approve')->nullable()->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
