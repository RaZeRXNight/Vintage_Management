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
            $table->string('Description')->nullable();
            $table->timestamps();
        });

        // Creating the Supplier table

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('SupplierName');
            $table->string('ContactName')->nullable();
            $table->string('ContactEmail')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Address')->nullable();
            $table->string('City')->nullable();
            $table->string('State')->nullable();
            $table->string('ZipCode')->nullable();
            $table->string('Country')->nullable();
            $table->string('Notes')->nullable();
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

        // Creating the Orders table
        // This table will hold the orders placed for products

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Foreign key to products table
            $table->foreignId('ProductID')->nullable()->constrained('products')->onDelete('set null');
            // Foreign key to suppliers table
            $table->foreignId('SupplierID')->nullable()->constrained('suppliers')->onDelete('set null');

            $table->decimal('UnitPrice', 10, 2);
            $table->integer('Quantity');
            $table->decimal('TotalPrice', 10, 2)->virtualAs('UnitPrice * Quantity'); // Virtual column for total price
            $table->dateTime('OrderDate')->default(now());
            $table->dateTime('ShippedDate')->nullable();
            $table->string('Status')->default('Pending'); // Status of the order
            $table->timestamps();
        });

        // Inserting default product categories
        DB::table('categories')->insert([
            ['CategoryName' => 'Misc.']
        ]);

        // Inserting default suppliers
        DB::table('suppliers')->insert([
            ['SupplierName' => 'Default Supplier',
                'ContactName' => 'John Doe',
                'ContactEmail' => 'john.doe@example.com',
                'Phone' => '123-456-7890'
            ]
        ]);

        // Inserting Default Product
        // This is just a sample of the product types that will be inserted into the database
        DB::table('products')->insert([
            [
                'ProductName' => 'T-Shirt',
                'CategoryID' => 1, 
                'Size' => 'S',
                'Description' => 'This is a t-shirt',
                'UnitPrice' => 15,
                'BuyPrice' => 10,
                'UnitsInStock' => 100,
                'UnitsOnOrder' => 50,
                'ReorderLevel' => 10,
                'Discontinued' => false
            ],
            [
                'ProductName' => 'Youth Shirt',
                'CategoryID' => 2, // Assuming this is the ID for 'Youth Shirt'
                'Size' => 'M',
                'Description' => 'This is a youth shirt',
                'BuyPrice' => 20,
                'UnitPrice' => 29.99,
                'UnitsInStock' => 200,
                'UnitsOnOrder' => 100,
                'ReorderLevel' => 20,
                'Discontinued' => false
            ],
            [
                'ProductName' => 'Long Sleeve Shirt',
                'CategoryID' => 3, // Assuming this is the ID for 'Long Sleeve'
                'Size' => 'L',
                'Description' => 'This is a long sleeve shirt',
                'BuyPrice' => 25,
                'UnitPrice' => 39.99,
                'UnitsInStock' => 150,
                'UnitsOnOrder' => 75,
                'ReorderLevel' => 15,
                'Discontinued' => false
            ]
        ]);

        // Inserting default orders
        // DB::table('orders')->insert([
        //     [
        //         'SupplierID' => 1, 
        //         'ProductID' => 1,
        //         'UnitPrice' => 15,
        //         'Quantity' => 2
        //     ],
        //     [
        //         'SupplierID' => 1, // Assuming this is the ID for 'Default Supplier'
        //         'ProductID' => 2,
        //         'UnitPrice' => 29.99,
        //         'Quantity' => 1
        //     ],
        //     [
        //         'SupplierID' => 1, // Assuming this is the ID for 'Default Supplier'
        //         'ProductID' => 3,
        //         'UnitPrice' => 39.99,
        //         'Quantity' => 3
        //     ]
        // ]);
        
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        // Schema::dropIfExists('orders');
        Schema::enableForeignKeyConstraints();
    }
};
