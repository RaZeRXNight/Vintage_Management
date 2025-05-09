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
        // Creating the productcategories table
        // This table will hold the product categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id('ID')->primary()->autoIncrement();
            $table->string('CategoryName');
            $table->timestamps();
        });

        // Inserting default product categories
        DB::table('categories')->insert([
            ['CategoryName' => 'T-Shirt'],
            ['CategoryName' => 'Youth Shirt'],
            ['CategoryName' => 'Long Sleeve'],
            ['CategoryName' => 'Button-up'],
            ['CategoryName' => 'Sunglasses'],
            ['CategoryName' => 'Hoodie'],
            ['CategoryName' => 'Sweater'],
            ['CategoryName' => 'Ash Tray'],
            ['CategoryName' => 'Misc.']
        ]);

        // Creating the products table
        Schema::create('products', function (Blueprint $table) {
            $Product_Types = array('T-Shirt', 'Youth Shirt',  'Long Sleeve', 'Button-up', 'Sunglasses', 'Hoodie', 'Sweater', 'Ash Tray', 'Misc.');
            
            $table->id('ID')->primary()->autoIncrement()->unique();
            $table->foreignId('SupplierID')->nullable();
            $table->foreignId('CategoryID')->nullable(); // Updated from ProductType to ProductCategory
            $table->longText('ProductIMG')->nullable();

            $table->longText('ProductName');
            $table->longText('Description')->nullable();
            $table->decimal('UnitPrice');
            $table->integer('UnitsInStock');
            $table->integer('UnitsOnOrder')->nullable();
            $table->smallInteger('ReorderLevel')->nullable(); 
            $table->boolean('Discontinued')->__call('nullable', [true]);
            $table->timestamps();
        });

        // Inserting Default Product
        // This is just a sample of the product types that will be inserted into the database
        DB::table('products')->insert([
            [
                'ProductName' => 'Sample Product',
                'CategoryID' => 1,
                'Description' => 'This is a sample product',
                'UnitPrice' => 19.99,
                'UnitsInStock' => 100,
                'UnitsOnOrder' => 50,
                'ReorderLevel' => 10,
                'Discontinued' => false
            ]
        ]);
        DB::table('products')->insert([
            [
                'ProductName' => 'Sample Product 2',
                'CategoryID' => 2,
                'Description' => 'This is another sample product',
                'UnitPrice' => 29.99,
                'UnitsInStock' => 200,
                'UnitsOnOrder' => 100,
                'ReorderLevel' => 20,
                'Discontinued' => false
            ]
        ]);
        DB::table('products')->insert([
            [
                'ProductName' => 'Sample Product 3',
                'CategoryID' => 3,
                'Description' => 'This is yet another sample product',
                'UnitPrice' => 39.99,
                'UnitsInStock' => 300,
                'UnitsOnOrder' => 150,
                'ReorderLevel' => 30,
                'Discontinued' => false
            ]
        ]);
        
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        // Schema::dropIfExists('orders');  

    }
};
