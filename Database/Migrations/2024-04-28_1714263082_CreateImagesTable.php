<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateImagesTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーションロジックをここに追加してください
        return [
            "CREATE TABLE images(
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(255),
                shared_url VARCHAR(255) NOT NULL,
                delete_url VARCHAR(255) NOT NULL,
                type VARCHAR(255) NOT NULL,
                image TEXT NOT NULL,
                viewd_count INT NOT NULL,
                last_acceessed_at DATETIME NOT NULL,
                ip_address VARCHAR(255) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        // ロールバックロジックを追加してください
        return [
            "DROP TABLE images"
        ];
    }
}
