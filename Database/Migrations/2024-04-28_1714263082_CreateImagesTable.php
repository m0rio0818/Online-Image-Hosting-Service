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
                size INT NOT NULL,
                image_url TEXT NOT NULL,
                viewed_count INT NOT NULL,
                publish BOOLEAN NOT NULL,
                ip_address VARCHAR(255) NOT NULL,
                last_acceessed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
