<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Helpers\DatabaseHelper;

class CheckLastAccess extends AbstractCommand
{
    // TODO: エイリアスを設定してください。
    protected static ?string $alias = 'checkLastAccess';

    // TODO: 引数を設定してください。
    public static function getArguments(): array
    {
        return [];
    }

    // TODO: 実行コードを記述してください。
    public function execute(): int
    {
        $this->log('Starting an access check.......');
        $this->accessCheck();
        return 0;
    }

    public function accessCheck(): void
    {
        date_default_timezone_set('Asia/Tokyo');
        $oldData = DatabaseHelper::getInActivein30days();


        $uploadImage = __DIR__ . "/../../public/";

        if (empty($oldData)) {
            $this->log('No data exceeds 30 days.');
        } else {
            DatabaseHelper::deleteInActivein30days();

            foreach ($oldData as $file) {
                $currentData = $uploadImage . $file;
                echo $currentData;
                unlink($currentData);
                $this->log("Delete "  . $currentData);
            }
            $this->log("Access check complete.");
        }
    }
}
