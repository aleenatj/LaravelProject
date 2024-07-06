<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTypeToOrderItemsAndCartTables extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('product_type')->default('regular'); // Add product_type column with default value
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->string('product_type')->default('regular'); // Add product_type column with default value
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }
}
