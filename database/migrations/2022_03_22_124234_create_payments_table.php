<?php

use App\Models\Category;
use App\Models\Payment;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('creator_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('type')->default(Payment::TYPE_REGULAR);
            $table->text('title');
            $table->integer('amount')->default(0);
            $table->foreignIdFor(Category::class);
            $table->string('interval');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at')->nullable();

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
        Schema::dropIfExists('payments');
    }
};
