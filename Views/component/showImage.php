<div>
    <div class="flex flex-col justify-center py-2">
        <div class="py-1 flex justify-center items-center ">
            <div class="pr-2">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <p> <?php echo $data["title"] == "" ? "untitled" : $data["title"]  ?> </p>
        </div>
        <div class="py-1 flex justify-center items-center ">
            <div class="pr-2">
                <i class="fa-solid fa-eye"></i>
            </div>
            <p> <?php echo $data["viewed_count"] ?> views </p>
        </div>
        <div class="flex justify-center pt-3 mx-auto w-1/2">
            <img src="<?php echo substr($data["image_url"], 1); ?>" alt="<?php $data["title"] == "" ? "undefined" : $data["title"] ?>">
        </div>
    </div>
</div>