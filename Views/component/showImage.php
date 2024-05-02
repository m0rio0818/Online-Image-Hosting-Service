<div>
    <?php var_dump($data) ?>
    <div class="flex justify-center">
        <div class="flex items-center pr-3">
            <i class="fa-solid fa-eye"></i>
        </div>
        <p> <?php echo $data["viewed_count"] ?> views </p>
        <img src="<?php echo $data["image_url"];?>" alt="<?php $data["title"] == "" ? "undefined" : $data["title"] ?>">
    </div>
</div>