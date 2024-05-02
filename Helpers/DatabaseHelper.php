<?php

namespace Helpers;

use Database\MySQLWrapper;
use DateInterval;
use DateTime;
use DateTimeZone;
use Exception;

class DatabaseHelper
{
    public static function createNewSnippetHelper(string $highlight, string $title, string $validTime, string $content, string $hashedVal, bool $publish)
    {
        $db = new MySQLWrapper();

        $expiredAt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
        $valiable_Time = ValidationHelper::getExpirationTime();

        if ($validTime !== "never") {
            $expiredAt->add(new DateInterval($valiable_Time[$validTime]));
            $expiredAtFormatted = $expiredAt->format('Y-m-d H:i:s');
        } else {
            $expiredAtFormatted = null;
        }

        $stmt = $db->prepare("INSERT INTO snippets 
            (title, url, language, content, expiration, publish,  expire_at)
            VALUES (?, ?, ?, ?, ?, ?, ? )
            ");
        $stmt->bind_param('sssssis', $title, $hashedVal, $highlight, $content, $validTime, $publish, $expiredAtFormatted);
        $insertSuccess = $stmt->execute();
        $stmt->close();
        return $insertSuccess;
    }

    public static function deleteExpiredAt(string $url): string
    {
        $db = new MySQLWrapper();
        $stmt = $db->prepare("DELETE FROM snippets WHERE url = ?");
        $stmt->bind_param('s', $url);
        $stmt->execute();
        $result = $stmt->execute();
        if ($result) return "success";
        return "failed"; 
    }

    public static function getSnippeter(string $url): array | string
    {
        $db = new MySQLWrapper();
        $stmt = $db->prepare("SELECT * FROM snippets WHERE url = ?");
        $stmt->bind_param('s', $url);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return "nodata";
        } else {
            $data = $result->fetch_assoc();
            return $data;
        }
    }

    public static function getAllSnipetter(): array | string
    {
        $db = new MySQLWrapper();
        $stmt = $db->prepare("SELECT * FROM snippets WHERE publish = 1 AND (expire_at > NOW() OR expire_at IS NULL)");
        $stmt->execute();
        $ans = [];
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $ans[] = $row;
        }

        if (!$ans) {
            return "nodata";
        }
        return $ans;
    }
}
