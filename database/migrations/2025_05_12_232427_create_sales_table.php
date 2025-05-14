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
        // This will store information about all transactions made by users, It will also catalogue the Total amount of Each Sale Item and the Payment Method used.
        // The TransactionID will be used to link the transaction to the sales table
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('TransactionID')->primary();
            $table->foreignId('UserID')->constrained('users', 'id')->onDelete('cascade');
            $table->integer('Quantity')->nullable();
            $table->decimal('TotalPrice', 10, 2)->nullable();
            $table->string('PaymentMethod')->nullable();
            $table->string('TransactionStatus')->nullable();
            $table->timestamp('TransactionDate')->nullable()->default(now());
            $table->timestamps();
        });
        
        // Sales table creation for successful transactions
        // This table will store information about sales made and later be used for reports and deductions from the inventory
        Schema::create('sales', function (Blueprint $table) {
            $table->id('SaleID')->primary();
            $table->foreignId('TransactionID')->constrained('transactions', 'TransactionID')->onDelete('cascade');
            $table->foreignId('UserID')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('ProductID')->constrained('products', 'ID')->onDelete('cascade');
            $table->integer('Quantity')->nullable();
            $table->decimal('TotalPrice', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id('ReportID')->primary();
            $table->foreignId('UserID')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('SaleID')->constrained('sales', 'SaleID')->onDelete('cascade');
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
