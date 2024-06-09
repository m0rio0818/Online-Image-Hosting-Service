    <?php

    use Helpers\ValidationHelper;
    ?>
    <div class="p-40">
        <?php
        // var_dump($data);
        $urlMediaType = ValidationHelper::ImageTypeValidater($data["mimeType"]);
        $hashURL = $data["shared_url"];
        $createdFullURL = $urlMediaType . "/" . $hashURL;
        ?>
        <div class="flex justify-center items-center ">
            <p class="text-center break-words"><a href=<?php echo "../" . $createdFullURL ?> class="text-sky-400 hover:text-sky-600 hover:underline"><?php echo $createdFullURL ?></a> <br>のデータを削除しますがよろしいでしょうか？</p>
        </div>
        <div class="flex justify-center items-center py-20">
            <button id="delete_btn" class="py-2 px-6 bg-sky-500 hover:bg-sky-700 text-white font-bold rounded-xl">
                DELETE
            </button>
        </div>
        <div id="confirm_dialog"></div>
    </div>

    <script src="/js/delete.js"></script>