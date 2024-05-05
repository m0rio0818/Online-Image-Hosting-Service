<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\JSONRenderer;
use Response\Render\HTMLRenderer;

return [
    '' => function (): HTMLRenderer  | JSONRenderer {
        $method = $_SERVER['REQUEST_METHOD'];
        // GET method
        if ($method == "GET") {
            $time = $_SERVER['REMOTE_ADDR'];
            return new HTMLRenderer('component/topPage', ["time" => $time]);
        }
        // POST method
        else {
            $imageData = $_FILES['image'];

            $filePath = $imageData['tmp_name'];

            $jsonData = json_decode($_POST['data'], true);

            $fileSize = $imageData["size"];
            $publish = $jsonData["publish"];
            $title = $jsonData["title"];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $extension = pathinfo($imageData["name"], PATHINFO_EXTENSION);
            $createURL = hash('sha256', uniqid(mt_rand(), true));
            $deleteURL = hash('sha256', uniqid(mt_rand(), true));

            // MIMEタイプを取得
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $filePath);
            finfo_close($finfo);


            // 画像保存フォルダ(日付ベースで作成 yyyy/mm/dd)がない際は作成していく。
            $timeZone = new DateTimeZone('Asia/Tokyo');
            $now = new DateTime();
            $now->setTimezone($timeZone);

            $year = $now->format("Y");
            $month = $now->format("m");
            $day = $now->format("d");
            $root_dir = "./images";
            $save_dirPath = $root_dir . "/" . $year . "/" . $month . "/" . $day;
            $save_fullPath = $save_dirPath . "/" . $createURL . "." . $extension;

            if (!is_dir($save_dirPath)) {
                mkdir($save_dirPath, 0777, true);
            }

            if (!move_uploaded_file($imageData["tmp_name"], $save_fullPath)) {
                return new JSONRenderer(["status" => false, "ファイルの作成に失敗しました. 再度作成お願いします"]);
            } else {
                $inserted = DatabaseHelper::createNewImage($title, $createURL, $deleteURL, $fileSize, $mimeType,  $save_fullPath, 0, $publish, $ip_address);
                return new JSONRenderer(["status" => $inserted, "create_url" => "image/" . $createURL, "delete_url" => "delete/" . $deleteURL]);
            }
        }
    },
    'image' => function (): HTMLRenderer  | JSONRenderer {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
            $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlParts = explode('/', $currentUrl);

            if (count($urlParts) < 3) {
                return new HTMLRenderer('component/404', ["data" => "URL does not correct. need hashstring.<br> image/{hashstring}"]);
            }
            $publicPath = $urlParts[2];
            $result = DatabaseHelper::getImageBySharedURL($publicPath, "public");
            if ($result == "nodata") {
                return new HTMLRenderer('component/404', ["data" => "check the path. its not correct"]);
            }
            // 回数をカウントする
            return new HTMLRenderer('component/showImage', ["data" => $result]);
        }
    },
    'delete' => function (): HTMLRenderer  | JSONRenderer {
        $method = $_SERVER['REQUEST_METHOD'];
        // GET method
        if ($method == "GET") {
            $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlParts = explode('/', $currentUrl);

            if (count($urlParts) < 3) {
                return new HTMLRenderer('component/404', ["data" => "URL does not correct. need hashstring.<br> delete/{hashstring}"]);
            }
            $deleteURL = $urlParts[2];

            $result = DatabaseHelper::getImageByDeleteURL($deleteURL);

            if (!$result) {
                return new HTMLRenderer('component/404', ["data" => "check the path. its not correct or Its already been deleted."]);
            }
            return new HTMLRenderer('component/deleteImage', ["data" => $result]);
        } else {
            $jsonData = json_decode($_POST['data'], true);
            $deleteURL = $jsonData["deleteURL"];

            $imagePath = DatabaseHelper::getImagePathByDeleteURL($deleteURL);

            if (!unlink($imagePath)) {
                echo "Error deleting file.";
            }

            $result = DatabaseHelper::deleteDataByURL($deleteURL);
            if ($result) {
                return new JSONRenderer(["status" => true, "message" => "data succssfully deledeted."]);
            } else {
                return new JSONRenderer(["status" => false, "message" => "Threr is a problem of Delete data process."]);
            }
        }
    },
];
