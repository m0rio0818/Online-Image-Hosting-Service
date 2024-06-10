<div>
    <?php
    if ($data == "nodata") {
    ?>
        <div class="py-10">
            <h1 class="text-center"> No public Data</h1>
        </div>
    <?php
    } else { ?>
        <div id="public_images" class="flex justify-center flex-wrap">
            <?php
            for ($i = 0; $i < count($data); $i++) {
                $currImage = $data[$i];
            ?>
                <div class="w-1/5 sm:w-1/3 h-50 p-3 mx-1">
                    <img src="<?php echo substr($currImage["image_url"], 1) ?>" class="w-full object-cover" alt="">
                    <div class="text-center  pt-2 ">
                        <div class="py-1 flex justify-center items-center">
                            <div class="pr-1">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <p><?php echo $currImage["title"] == "" ? "undefined" : $currImage["title"] ?></p>
                        </div>
                        <div class="flex justify-center items-center">
                            <div class="pr-1">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <p><?php
                                $currImageCount = $currImage["viewed_count"];
                                if ($currImageCount <= 1) {
                                    echo $currImageCount . " view";
                                } else {
                                    echo $currImageCount . " views";
                                }
                                ?></p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    } ?>
</div>
<script src="/js/publicList.js"></script>