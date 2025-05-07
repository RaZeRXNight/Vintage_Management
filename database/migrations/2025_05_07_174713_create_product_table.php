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
        Schema::create('product', function (Blueprint $table) {
            $Product_Types = array('T-Shirt', 'Youth', 'Long Sleeve', 'Button-up', 'Sunglasses', 'Hoodie', 'Sweater', 'Ash Tray', 'Misc.');

            $table->id('ProductID');
            $table->longText('ProductIMG');
            $table->string('ProductName');
            $table->enum('Type', $Product_Types);
            $table->foreignId('SupplierID');
            $table->decimal('UnitPrice');
            $table->integer('UnitsInStock');
            $table->integer('UnitsOnOrder');
            $table->smallInteger('ReorderLevel');
            $table->boolean('Discontinued');
            $table->timestamps();
        });
        /*
        Schema::create('orders', function (Blueprint $table) {
            $Product_Types = array('T-Shirt', 'Youth', 'Long Sleeve', 'Button-up', 'Sunglasses', 'Hoodie', 'Sweater', 'Ash Tray', 'Misc.');

            $table->id('OrderID');
            $table->foreignId('ProductID');
            $table->decimal('UnitPrice');
            $table->integer('UnitsInStock');
            $table->integer('UnitsOnOrder');
            $table->smallInteger('ReorderLevel');
            $table->boolean('Discontinued');
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
        // Schema::dropIfExists('orders');
    }
};
