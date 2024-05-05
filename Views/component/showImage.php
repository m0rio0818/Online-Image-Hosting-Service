<div>
    <div class="flex flex-col justify-center">
        <div class="flex justify-center items-center ">
            <div class=" pr-3">
                <i class="fa-solid fa-eye"></i>
            </div>
            <p> <?php echo $data["viewed_count"] ?> views </p>
        </div>
        <div class="mx-auto w-1/2">
            <img src="<?php echo substr($data["image_url"], 1);?>" alt="<?php $data["title"] == "" ? "undefined" : $data["title"] ?>">
        </div>
    </div>
</div>