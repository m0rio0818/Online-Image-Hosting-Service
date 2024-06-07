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
        $oldData = DatabaseHelper::getInActicein30days();


        $uploadImage = __DIR__ . "../../public/images";

        if (empty($oldData)) {
            $this->log("No data last in 30 days");
        } else {
            DatabaseHelper::deleteInActicein30days();

            foreach ($oldData as $file) {
                $currentData = $uploadImage . $file;
                unlink($currentData);
                $this->log("Delete "  . $currentData);
            }
            $this->log("Access check complete.");
        }
    }
}
