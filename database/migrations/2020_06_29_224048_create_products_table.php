<?php

use App\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 1000);
            $table->integer('quantity')->unsigned();
            $table->string('status')->default(Product::UNAVAILABLE_PRODUCT);
            $table->string('image');
            $table->integer('seller_id')->unsigned();
            $table->timestamps();
            $table->softDeletes(); // Deleted at

            $table->foreign('seller_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
