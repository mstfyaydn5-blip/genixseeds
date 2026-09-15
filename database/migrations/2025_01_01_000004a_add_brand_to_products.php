<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('brand')->default('genix')->after('slug');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->default('genix')->after('product_category_id');
            $table->string('sku')->nullable()->after('brand');
        });
    }

    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('brand');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'sku']);
        });
    }
};
