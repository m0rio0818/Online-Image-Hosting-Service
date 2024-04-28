<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\JSONRenderer;
use Response\Render\HTMLRenderer;

return [
    '' => function (): HTMLRenderer  | JSONRenderer {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            $time = $_SERVER['REMOTE_ADDR'];
            return new HTMLRenderer('component/topPage', ["time" => $time]);
        }
        // POST method
        else {
            $json_data = file_get_contents('php://input');
            // JSONデータをデコードして連想配列に変換する
            $data = json_decode($json_data, true);

            $highlight = $data["syntax_highlight"];
            $title = $data["title"];
            $validTime = $data["validTime"];
            $content = $data["content"];
            $publish = $data["publish"];
            $hashedValue = hash('sha256', uniqid(mt_rand(), true));
            $inserted = DatabaseHelper::createNewSnippetHelper($highlight, $title, $validTime, $content, $hashedValue, $publish);

            if ($inserted) {
                return new JSONRenderer(["success" => true, "url" => "snippet/{$hashedValue}"]);
            } else {
                return new JSONRenderer(["success" => false]);
            }
        }
    },
    'snippet' => function (): HTMLRenderer {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            $currentUrl = $_SERVER['REQUEST_URI'];
            $urlParts = explode('/', $currentUrl);
            if (count($urlParts) < 3) {
                return new HTMLRenderer('component/404', ["data" => "url does not correct. need hashstring.\n/snippet/{hashstring}"]);
            }
            $snippetPath = $urlParts[2];
            $data = DatabaseHelper::getSnippeter($snippetPath);
            $expire_at = $data["expire_at"];
            $url = $data["url"];

            if (!is_null($expire_at)) {
                $expire_time = strtotime($expire_at);
                $currentTime = time();
                if ($expire_time < $currentTime) {
                    // DBからurlを削除する。
                    $result = DatabaseHelper::deleteExpiredAt($url);
                    return new HTMLRenderer('component/expire_snippet', ["data" => "deleted data FROM DB"]);
                }
            }

            if ($data == "nodata") {
                // ハッシュが一致しない場合のurl
                return new HTMLRenderer('component/404', ["data" => "url '/snippet/$snippetPath' does not exist"]);
            }
            return new HTMLRenderer('component/snippet', ["data" => $data]);
        }
    },
    'snippet_List' => function (): HTMLRenderer {
        $snippets = DatabaseHelper::getAllSnipetter();
        if ($snippets == "nodata") {
            return new HTMLRenderer('component/404', ["data" => "there is no public data at current Database. create new public snippet"]);
        }
        return new HTMLRenderer('component/snippet_Lists', ["snippets" => $snippets]);
    }
];
