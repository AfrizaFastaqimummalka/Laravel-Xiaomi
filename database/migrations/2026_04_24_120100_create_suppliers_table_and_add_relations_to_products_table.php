<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('phone', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 500)->nullable();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')->constrained('categories')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->after('category_id')->constrained('suppliers')->nullOnDelete();
        });

        $defaultSupplierId = DB::table('suppliers')->insertGetId([
            'name' => 'Supplier Umum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categoryNames = DB::table('products')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        foreach ($categoryNames as $name) {
            $id = DB::table('categories')->insertGetId([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('products')
                ->where('category', $name)
                ->update(['category_id' => $id]);
        }

        DB::table('products')
            ->whereNull('supplier_id')
            ->update(['supplier_id' => $defaultSupplierId]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::dropIfExists('suppliers');
    }
};
