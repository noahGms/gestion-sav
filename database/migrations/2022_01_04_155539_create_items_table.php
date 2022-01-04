<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->text('comment_state')->nullable();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('intervention_date')->nullable();
            $table->foreignId('intervention_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('depot_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('return_date')->nullable();
            $table->foreignId('return_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->text('defaults')->nullable();
            $table->text('observations')->nullable();
            $table->text('reparations')->nullable();
            $table->text('comments')->nullable();
            $table->text('communications')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
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
        Schema::dropIfExists('items');
    }
}
