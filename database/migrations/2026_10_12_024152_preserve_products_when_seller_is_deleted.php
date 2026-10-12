
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 保留已刪除賣家的商品，避免歷史訂單明細失去關聯。
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            $table->unsignedBigInteger('user_id')->nullable()->change();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * 回復原本的商品外鍵設定。
     */
    
    public function down(): void
    {
        throw new \RuntimeException(
            '此 migration 可能已有 user_id 為 NULL 的商品，請先人工確認資料再回復。'
        );
    }

};
