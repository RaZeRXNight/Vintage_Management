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
            $table->id();
            $table->string('CategoryName');
            $table->timestamps();
        });

        // Creating the Supplier table

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('SupplierName');
            $table->string('ContactName')->nullable();
            $table->string('ContactEmail')->nullable();
            $table->string('Phone')->nullable();
            $table->timestamps();
        });

        // Creating the products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('SupplierID')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('CategoryID')->nullable()->constrained('categories')->onDelete('set null'); // Updated from ProductType to ProductCategory
            $table->longText('ProductIMG')->nullable();

            $table->longText('ProductName');
            $table->text('Size')->nullable();
            $table->longText('Description')->nullable();
            $table->decimal('BuyPrice', 10, 2)->nullable();
            $table->decimal('UnitPrice', 10, 2)->nullable();
            $table->integer('UnitsInStock')->nullable();
            $table->integer('UnitsOnOrder')->nullable();
            $table->smallInteger('ReorderLevel')->nullable();
            $table->boolean('Discontinued')->nullable();
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

        // Inserting Default Product
        // This is just a sample of the product types that will be inserted into the database
        DB::table('products')->insert([
            [
                'ProductName' => 'Sample Product',
                'CategoryID' => 1, // Assuming this is the ID for 'T-Shirt'
                'Size' => 'S',
                'Description' => 'This is a sample product',
                'UnitPrice' => 15,
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

            $table->id();
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
        Schema::disableForeignKeyConstraints();

        // Dropping the products, categories, and suppliers tables
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        // Schema::dropIfExists('orders');
        Schema::enableForeignKeyConstraints();
    }
};
