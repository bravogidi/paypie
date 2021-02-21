<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('SenderId');
            $table->unsignedBigInteger('BeneficiaryId');
            $table->string('TransactionType');
            $table->string('PaymentMethod');
            $table->string('Currency');
            $table->double('Amount');
            $table->string('RefNo');
            $table->string('OrderRef')->nullable();
            $table->string('Status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('SenderId')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('BeneficiaryId')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
