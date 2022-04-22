<?php

use App\Models\Payment;
use App\Models\Shop;
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
        Schema::table('payments', function (Blueprint $table) {
            $table->after('creator_id', function ($table) {
                $table->string('account_type')->default(Payment::ACCOUNT_TYPE_LEDGER);
            });
            $table->after('type', function ($table) {
                $table->foreignIdFor(Shop::class)->nullable()->constrained();
            });

            $table->renameColumn('type', 'payment_type');
            $table->string('title')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('payment_type', 'type');
            $table->dropColumn('account_type');
            $table->dropColumn('shop_id');
        });
    }
};
