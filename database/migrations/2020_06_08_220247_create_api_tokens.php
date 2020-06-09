<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('user_id')->index();
            $table->string('name');
            $table->char('token', 64)->unique();
            $table->timestamp('token_expires_at')->index();
            $table->char('refresh', 64)->unique();
            $table->timestamp('refresh_expires_at')->index();
            $table->timestamp('last_used_at')->nullable()->index();
            $table->timestamp('destroyed_at')->nullable()->index();
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_tokens');
    }
}
