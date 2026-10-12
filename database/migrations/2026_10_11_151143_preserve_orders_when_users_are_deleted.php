<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 一次調整訂單欄位與外鍵規則
        DB::statement("
            ALTER TABLE orders
                ADD COLUMN seller_name VARCHAR(255) NULL AFTER seller_id,
                DROP FOREIGN KEY orders_user_id_foreign,
                DROP FOREIGN KEY orders_seller_id_foreign,
                MODIFY user_id BIGINT UNSIGNED NULL,
                MODIFY seller_id BIGINT UNSIGNED NULL,
                ADD CONSTRAINT orders_user_id_set_null_fk
                    FOREIGN KEY (user_id) REFERENCES users(id)
                    ON DELETE SET NULL,
                ADD CONSTRAINT orders_seller_id_set_null_fk
                    FOREIGN KEY (seller_id) REFERENCES users(id)
                    ON DELETE SET NULL
        ");

        // 為尚未記錄賣家的舊訂單，依商品資料補上賣家 ID。
        // 只有訂單內所有商品都屬於同一位賣家時才補值。
        DB::statement("
            UPDATE orders
            INNER JOIN (
                SELECT
                    order_items.order_id,
                    MIN(products.user_id) AS seller_id
                FROM order_items
                INNER JOIN products
                    ON order_items.product_id = products.id
                GROUP BY order_items.order_id
                HAVING COUNT(DISTINCT products.user_id) = 1
                   AND COUNT(products.user_id) = COUNT(*)
            ) AS order_sellers
                ON orders.id = order_sellers.order_id
            SET orders.seller_id = order_sellers.seller_id
            WHERE orders.seller_id IS NULL
        ");

        // 為既有訂單補上賣家名稱快照
        DB::statement("
            UPDATE orders
            INNER JOIN users ON orders.seller_id = users.id
            SET orders.seller_name = users.name
            WHERE orders.seller_name IS NULL
        ");
    }

    public function down(): void
    {
        // 回復外鍵規則，但保留 user_id 可為 NULL，
        // 避免已有買家帳號刪除的歷史訂單無法回復
        DB::statement("
            ALTER TABLE orders
                DROP FOREIGN KEY orders_user_id_set_null_fk,
                DROP FOREIGN KEY orders_seller_id_set_null_fk,
                ADD CONSTRAINT orders_user_id_foreign
                    FOREIGN KEY (user_id) REFERENCES users(id)
                    ON DELETE CASCADE,
                ADD CONSTRAINT orders_seller_id_foreign
                    FOREIGN KEY (seller_id) REFERENCES users(id)
                    ON DELETE RESTRICT,
                DROP COLUMN seller_name
        ");
    }
};