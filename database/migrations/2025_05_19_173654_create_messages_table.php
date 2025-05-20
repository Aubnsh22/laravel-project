<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->json('recipients')->comment('JSON array of user IDs or departments');
            $table->text('content');
            $table->timestamp('sent_at')->useCurrent();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
             $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
