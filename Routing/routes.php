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
            $jsonData = json_decode($_POST['data'], true);

            $public = $jsonData["public"];
            $title = $jsonData["title"];
            $ip_address = $_SERVER['REMOTE_ADDR'];

            return new JSONRenderer(["success" => true, "image" => $imageData, "public" => $public, "title" => $title]);
   
        }
    },
];
