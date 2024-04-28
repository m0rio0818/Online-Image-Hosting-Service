<?php

namespace Database\Seeds;

use Database\AbstractSeeder;


class SnippetSeeder extends AbstractSeeder
{
    protected ?string $tableName = "text_snippet";
    protected array $tableColumns = [
        [
            "data_type" => "string",
            "column_name" => "title"
        ],
        [
            "data_type" => "string",
            "column_name" => "url"
        ],
        [
            "data_type" => "string",
            "column_name" => "language"
        ],
        [
            "data_type" => "string",
            "column_name" => "content"
        ],
        [
            "data_type" => "DateTime",
            "column_name" => "expire_at"
        ],
        [
            "data_type" => "DateTime",
            "column_name" => "created_at"
        ]
    ];

    public function createRowData(): array
    {
        return [];
    }
}
