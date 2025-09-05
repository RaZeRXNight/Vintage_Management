<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Transactions Table for Pending and Successful Transactions
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserID');
            $table->integer('Quantity')->nullable();
            $table->decimal('TotalPrice', 10, 2)->nullable();
            $table->string('PaymentMethod')->nullable();
            $table->string('TransactionStatus')->nullable();
            $table->timestamp('TransactionDate')->nullable()->default(now());
            $table->timestamps();
        });
        
        // Sales table creation for successful transactions
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('TransactionID')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('UserID')->constrained('users')->onDelete('cascade');
            $table->foreignId('ProductID')->constrained('products')->onDelete('cascade');
            $table->integer('Quantity')->nullable();
            $table->decimal('TotalPrice', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserID')->constrained('users')->onDelete('cascade');
            $table->foreignId('SaleID')->constrained('sales')->onDelete('cascade');
            $table->string('ReportType')->nullable();
            $table->text('ReportDetails')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        // Dropping the reports, sales, and transactions tables
        Schema::dropIfExists('sales');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('reports');
        
        Schema::enableForeignKeyConstraints();
    }
};
