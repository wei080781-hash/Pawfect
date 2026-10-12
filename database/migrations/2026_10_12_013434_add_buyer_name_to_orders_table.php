<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('buyer_name')
                ->nullable()
                ->after('user_id');
        });

        // 為仍能找到買家的既有訂單補上姓名快照
        DB::statement("
            UPDATE orders
            INNER JOIN users ON orders.user_id = users.id
            SET orders.buyer_name = users.name
            WHERE orders.buyer_name IS NULL
        ");
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('buyer_name');
        });
    }
};
